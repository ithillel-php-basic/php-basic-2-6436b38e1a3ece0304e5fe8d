<?php

require 'helpers.php';
$config = require 'config.php';

$db = connect_to_mysql_db($config['hostname'], $config['username'], $config['password'], $config['database']);

$check_form = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check_from = check_register_form($db, $_POST);
    if ($check_from['status'] == 'success') {
        if (create_user($db, $_POST)) {
            setcookie('success-action', 'Успішна реєстрація!', time() + 3);
            header('Location: /', true, 301);
        } else setcookie('error-action', 'При реєстрації виникла помилка', time() + 3);
    } else $_SESSION = $check_from['data'];
}

$register_template = renderTemplate('register.php');

print renderTemplate('layout.php', [
    'page_title' => 'Створення облікового запису',
    'links' => [
        'css' => [
            '/static/plugins/fontawesome-free/css/all.min.css',
            '/static/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
            '/static/css/adminlte.min.css',
            '/static/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
        ],
        'js' => [
            '/static/plugins/jquery/jquery.min.js',
            '/static/plugins/bootstrap/js/bootstrap.bundle.min.js',
            '/static/dist/js/adminlte.min.js',
        ]
    ],
    'body_options' => 'hold-transition register-page',
    'body_content' => $register_template
]);
