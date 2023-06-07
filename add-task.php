<?php

require 'helpers.php';
$config = require 'config.php';

/**
 * Connect to DB
 */
$db = connect_to_mysql_db($config['hostname'], $config['username'], $config['password'], $config['database']);

/**
 * Get projects for user USERID
 */
$projects = get_projects($db, USERID);
$check_from = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check_from = check_add_task_from(['POST' => $_POST, 'FILE' => $_FILES], $projects);
    if ($check_from['status'] == 'success') {
        if (create_task($db, ['POST' => $_POST, 'FILE' => $_FILES], $check_from['data'], USERID)) {
            setcookie('success-action', 'Успішне створення задачі', time() + 3);
            header('Location: /', true, 301);
        } else setcookie('error-action', 'При створенні задачі сталася помилка', time() + 3);
    } else $_SESSION = $check_from['data'];
}

$task_add_template = renderTemplate('task-add.php', [
    'projects' => $projects,
]);

$main_template = renderTemplate('main.php', [
    'app_version' => APP_VERSION,
    'wrapper_content' => $task_add_template,
    'user_name' => USERNAME . ' (ID: ' . USERID . ')',
    'user_photo' => 'https://en.gravatar.com/userimage/113651460/9f8c526466d42444c8a4d8d0b9bf1990.jpg?size=200',
    'projects' => $projects,
    'tasks' => false
]);

print renderTemplate('layout.php', [
    'page_title' => 'Створення задачі',
    'style' => [
        'css' => [
            '/static/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'
        ]
    ],
    'body_content' => $main_template
]);