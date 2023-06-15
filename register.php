<?php

require 'helpers.php';
$config = require 'config.php';

$db = connect_to_mysql_db($config['hostname'], $config['username'], $config['password'], $config['database']);

$check_form = '';
$form_data = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_data = $_POST;
    $check_from = check_register_form($db, $form_data);
    if (!is_array($check_from)) {
        if (create_user($db, $_POST)) {
            setcookie('success-action', 'Успішна реєстрація!', time() + 3);
            header('Location: /', true, 301);
        } else {
            setcookie('error-action', 'При реєстрації виникла помилка', time() + 3);
        }
    } else {
        $check_form = $check_from;
    }
}

$register_template = renderTemplate('register.php', [
    'form_result' => $check_form,
    'form_data' => $form_data
]);

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
            '/static/js/adminlte.min.js',
        ]
    ],
    'body_options' => 'hold-transition register-page',
    'body_content' => $register_template
]);
