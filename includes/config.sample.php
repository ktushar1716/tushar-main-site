<?php
/* ==========================================================================
   CONFIG.SAMPLE.PHP — copy to includes/config.php and fill in.

   config.php holds real credentials, so it is gitignored. It returns an
   array and prints nothing, so requesting it in a browser shows a blank page.
   ========================================================================== */

return [
    // MySQL database the contact form saves messages into. The table is
    // created automatically on first use; the database and user are not.
    'db' => [
        'host' => 'localhost',
        'name' => 'portfolio',
        'user' => 'portfolio_user',
        'pass' => 'change-me',
    ],

    // Password for messages.php, stored as a hash. Generate one with:
    //   php -r "echo password_hash('your-password', PASSWORD_DEFAULT), PHP_EOL;"
    'admin_password_hash' => '',
];
