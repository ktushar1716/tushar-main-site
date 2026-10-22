<?php
/* ==========================================================================
   MESSAGES.PHP — private inbox for contact form submissions.

   Password-protected (hash in includes/config.php). Lists messages newest
   first, with mark read/unread and delete. Not linked from anywhere and kept
   out of search results, but the password is what actually protects it.
   ========================================================================== */

require __DIR__ . '/includes/db.php';

const PER_PAGE = 25;

session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Lax',
    'secure'   => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
]);
session_start();

header('X-Robots-Tag: noindex, nofollow');
header('Cache-Control: no-store');

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function redirect_self(array $query = []): void
{
    header('Location: messages.php' . ($query ? '?' . http_build_query($query) : ''), true, 303);
    exit;
}

$_SESSION['csrf'] ??= bin2hex(random_bytes(16));
$csrf = $_SESSION['csrf'];
$loggedIn = !empty($_SESSION['inbox_auth']);
$error = '';

/* ---------- Actions (all POST, all CSRF-checked) ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($csrf, (string)($_POST['csrf'] ?? ''))) {
        http_response_code(400);
        exit('Session expired. Go back and reload the page.');
    }

    $action = $_POST['action'] ?? '';

    if ($action === 'login') {
        $hash = app_config()['admin_password_hash'] ?? '';
        if ($hash !== '' && password_verify((string)($_POST['password'] ?? ''), $hash)) {
            session_regenerate_id(true);
            $_SESSION['inbox_auth'] = true;
            redirect_self();
        }
        sleep(1); // slow down guessing
        $error = $hash === '' ? 'No admin password is set in includes/config.php.' : 'Wrong password.';
    } elseif ($action === 'logout') {
        $_SESSION = [];
        session_destroy();
        redirect_self();
    } elseif ($loggedIn) {
        $id   = (int)($_POST['id'] ?? 0);
        $page = max(1, (int)($_POST['page'] ?? 1));
        if ($action === 'read' || $action === 'unread') {
            db()->prepare('UPDATE contact_messages SET is_read = ? WHERE id = ?')->execute([$action === 'read' ? 1 : 0, $id]);
        } elseif ($action === 'delete') {
            db()->prepare('DELETE FROM contact_messages WHERE id = ?')->execute([$id]);
        }
        redirect_self($page > 1 ? ['page' => $page] : []);
    }
}

/* ---------- Data ---------- */
$rows = [];
$total = $unread = 0;
$page = max(1, (int)($_GET['page'] ?? 1));
$dbError = '';

if ($loggedIn) {
    try {
        $total  = (int)db()->query('SELECT COUNT(*) FROM contact_messages')->fetchColumn();
        $unread = (int)db()->query('SELECT COUNT(*) FROM contact_messages WHERE is_read = 0')->fetchColumn();
        $pages  = max(1, (int)ceil($total / PER_PAGE));
        $page   = min($page, $pages);
        $stmt = db()->prepare('SELECT * FROM contact_messages ORDER BY created_at DESC, id DESC LIMIT ? OFFSET ?');
        $stmt->execute([PER_PAGE, ($page - 1) * PER_PAGE]);
        $rows = $stmt->fetchAll();
    } catch (Throwable $ex) {
        $dbError = $ex->getMessage();
    }
}
$pages = max(1, (int)ceil($total / PER_PAGE));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title><?php echo $loggedIn && $unread ? "($unread) " : ''; ?>Inbox | Tushar Khamparia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.ico" sizes="48x48">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
<main class="inbox">

<?php if (!$loggedIn): ?>
    <form class="login-card" method="POST" action="messages.php">
        <p class="eyebrow">PRIVATE</p>
        <h1>Inbox</h1>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" autocomplete="current-password" autofocus required>
        <input type="hidden" name="csrf" value="<?php echo e($csrf); ?>">
        <input type="hidden" name="action" value="login">
        <?php if ($error): ?><p class="alert"><?php echo e($error); ?></p><?php endif; ?>
        <button type="submit" class="btn btn-primary">Log in</button>
    </form>

<?php else: ?>
    <header class="inbox-head">
        <div>
            <p class="eyebrow">CONTACT FORM</p>
            <h1>Inbox</h1>
            <p class="muted"><?php echo $total; ?> message<?php echo $total === 1 ? '' : 's'; ?> · <?php echo $unread; ?> unread</p>
        </div>
        <form method="POST" action="messages.php">
            <input type="hidden" name="csrf" value="<?php echo e($csrf); ?>">
            <button name="action" value="logout" class="btn">Log out</button>
        </form>
    </header>

    <?php if ($dbError): ?>
        <p class="alert">Couldn't load messages: <?php echo e($dbError); ?></p>
    <?php elseif (!$rows): ?>
        <p class="empty">No messages yet.</p>
    <?php endif; ?>

    <?php foreach ($rows as $m): ?>
        <?php
            $replySubject = 'Re: ' . ($m['subject'] !== '' ? $m['subject'] : 'Your message');
            $when = date('j M Y, g:i A', strtotime($m['created_at']));
        ?>
        <article class="msg<?php echo $m['is_read'] ? '' : ' is-unread'; ?>">
            <div class="msg-head">
                <div>
                    <h2><?php echo e($m['subject'] !== '' ? $m['subject'] : '(no subject)'); ?></h2>
                    <p class="from">
                        <strong><?php echo e($m['name']); ?></strong>
                        &lt;<a href="mailto:<?php echo e($m['email']); ?>?subject=<?php echo e(rawurlencode($replySubject)); ?>"><?php echo e($m['email']); ?></a>&gt;
                    </p>
                </div>
                <time datetime="<?php echo e($m['created_at']); ?>"><?php echo e($when); ?></time>
            </div>
            <p class="body"><?php echo e($m['message']); ?></p>
            <form class="msg-actions" method="POST" action="messages.php">
                <input type="hidden" name="csrf" value="<?php echo e($csrf); ?>">
                <input type="hidden" name="id" value="<?php echo (int)$m['id']; ?>">
                <input type="hidden" name="page" value="<?php echo $page; ?>">
                <a class="btn btn-primary" href="mailto:<?php echo e($m['email']); ?>?subject=<?php echo e(rawurlencode($replySubject)); ?>">Reply</a>
                <?php if ($m['is_read']): ?>
                    <button name="action" value="unread" class="btn">Mark unread</button>
                <?php else: ?>
                    <button name="action" value="read" class="btn">Mark read</button>
                <?php endif; ?>
                <button name="action" value="delete" class="btn btn-danger" onclick="return confirm('Delete this message for good?');">Delete</button>
                <?php if ($m['ip']): ?><span class="meta">IP <?php echo e($m['ip']); ?></span><?php endif; ?>
            </form>
        </article>
    <?php endforeach; ?>

    <?php if ($pages > 1): ?>
        <nav class="pager">
            <?php if ($page > 1): ?><a class="btn" href="?page=<?php echo $page - 1; ?>">← Newer</a><?php endif; ?>
            <span class="muted">Page <?php echo $page; ?> of <?php echo $pages; ?></span>
            <?php if ($page < $pages): ?><a class="btn" href="?page=<?php echo $page + 1; ?>">Older →</a><?php endif; ?>
        </nav>
    <?php endif; ?>
<?php endif; ?>

</main>
</body>
</html>
