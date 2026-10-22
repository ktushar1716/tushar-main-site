<?php
/* ==========================================================================
   CONTACT.PHP — handles the contact form on the home page.

   The form posts here with fetch() and expects JSON back:
     { "ok": true,  "message": "..." }
     { "ok": false, "message": "...", "field": "contact-email" }   // field optional

   Without JavaScript the form posts here normally, and we redirect back to
   the home page with ?contact=sent|error so the page can still respond.

   Every valid submission is saved to the contact_messages table (read them at
   messages.php). The email is only a notification on top: the visitor is told
   it worked if either the save or the email succeeded.
   ========================================================================== */

require __DIR__ . '/includes/db.php';

const CONTACT_TO   = 'khampariatushar@gmail.com';
const CONTACT_FROM = 'no-reply@tusharkhamparia.in';   // must be on the site's own domain or hosts reject it
const MIN_GAP_SECS = 30;                              // per-session cooldown between messages

session_start();

$isAjax = ($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'fetch';

function respond(bool $ok, string $message, ?string $field = null, int $status = 200): void
{
    global $isAjax;

    if (!$isAjax) {
        header('Location: ./?contact=' . ($ok ? 'sent' : 'error') . '#contact', true, 303);
        exit;
    }

    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array_filter(
        ['ok' => $ok, 'message' => $message, 'field' => $field],
        fn($v) => $v !== null
    ));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Method not allowed.', null, 405);
}

// Honeypot: a field hidden from people. Bots fill it; pretend it worked.
if (!empty($_POST['website'])) {
    respond(true, "Thanks! Your message has been sent.");
}

$name    = trim((string)($_POST['name'] ?? ''));
$email   = trim((string)($_POST['email'] ?? ''));
$subject = trim((string)($_POST['subject'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));

if ($name === '' || mb_strlen($name) > 100) {
    respond(false, 'Please enter your name.', 'contact-name', 422);
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 254) {
    respond(false, 'Please enter a valid email address.', 'contact-email', 422);
}
if (mb_strlen($subject) > 150) {
    respond(false, 'Subject is too long (150 characters max).', 'contact-subject', 422);
}
if (mb_strlen($message) < 10) {
    respond(false, 'Your message is a little short. Tell me a bit more.', 'contact-message', 422);
}
if (mb_strlen($message) > 5000) {
    respond(false, 'Your message is too long (5000 characters max).', 'contact-message', 422);
}

$last = $_SESSION['contact_last_sent'] ?? 0;
if (time() - $last < MIN_GAP_SECS) {
    respond(false, 'You just sent a message. Please wait a few seconds before sending another.', null, 429);
}

// Header values must never contain line breaks, or they can inject headers.
$clean = fn(string $s) => str_replace(["\r", "\n"], ' ', $s);
$name    = $clean($name);
$subject = $clean($subject);

$mailSubject = '[Portfolio] ' . ($subject !== '' ? $subject : "New message from $name");
$body = "Name:    $name\n"
      . "Email:   $email\n"
      . "Subject: " . ($subject !== '' ? $subject : '-') . "\n"
      . "Sent:    " . date('Y-m-d H:i:s') . "\n"
      . "IP:      " . ($_SERVER['REMOTE_ADDR'] ?? '-') . "\n\n"
      . $message . "\n";

$saved = false;
try {
    db()->prepare('INSERT INTO contact_messages (name, email, subject, message, ip, user_agent) VALUES (?, ?, ?, ?, ?, ?)')
        ->execute([
            $name,
            $email,
            $subject,
            $message,
            $_SERVER['REMOTE_ADDR'] ?? null,
            mb_substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255) ?: null,
        ]);
    $saved = true;
} catch (Throwable $e) {
    error_log('contact.php: could not save message: ' . $e->getMessage());
}

$headers = implode("\r\n", [
    'From: Tushar Khamparia Portfolio <' . CONTACT_FROM . '>',
    'Reply-To: ' . $name . ' <' . $email . '>',
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
    'X-Mailer: PHP/' . PHP_VERSION,
]);

$sent = @mail(CONTACT_TO, '=?UTF-8?B?' . base64_encode($mailSubject) . '?=', $body, $headers, '-f' . CONTACT_FROM);

if (!$saved && !$sent) {
    respond(false, "Sorry, the message couldn't be sent right now. Please email me directly at " . CONTACT_TO . '.', null, 500);
}

$_SESSION['contact_last_sent'] = time();
respond(true, "Thanks, $name! Your message has been sent. I'll get back to you soon.");
