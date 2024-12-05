<?php

$routeFiles = [
    'admin.php',
    'auth.php',
    'boards.php',
    'files.php',
    'forums.php',
    'posts.php',
    'profile.php',
    'web.php'
];

foreach ($routeFiles as $file) {
    require __DIR__ . "/web/" . $file;
}
