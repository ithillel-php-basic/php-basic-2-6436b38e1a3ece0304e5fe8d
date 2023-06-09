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

/**
 * Get all tasks or tasks for USERID or for USERID with Project ID
 */
$tasks = (!isset($_GET['project']) ? get_tasks($db, USERID) : get_tasks($db, USERID, $_GET['project']));

/** @var TYPE_NAME $kanban_template */
$kanban_template = renderTemplate('kanban.php', [
    'tasks' => $tasks,
    'project_title' => get_project_name($projects, isset($_GET['project'])),
    'breadcrumb' => get_project_name($projects, isset($_GET['project']), true),
]);

/** @var TYPE_NAME $main_template */
$main_template = renderTemplate('main.php', [
    'app_version' => APP_VERSION,
    'wrapper_content' => $kanban_template,
    'user_name' => USERNAME . ' (ID: ' . USERID . ')',
    'user_photo' => 'https://en.gravatar.com/userimage/113651460/9f8c526466d42444c8a4d8d0b9bf1990.jpg?size=200',
    'projects' => $projects,
    'tasks' => $tasks
]);

print renderTemplate('layout.php', [
    'page_title' => 'Головна',
    'links' => [
        'css' => [
            '/static/plugins/ekko-lightbox/ekko-lightbox.css',
            '/static/css/adminlte.min.css',
            '/static/css/kanban.css',
            '/static/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'
        ],
        'js' => [
            '/static/plugins/jquery/jquery.min.js',
            '/static/plugins/jquery-ui/jquery-ui.min.js',
            '/static/plugins/bootstrap/js/bootstrap.bundle.min.js',
            '/static/plugins/ekko-lightbox/ekko-lightbox.min.js',
            '/static/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
            '/static/js/adminlte.min.js',
            '/static/plugins/filterizr/jquery.filterizr.min.js',
            '/static/js/kanban.js',
        ]
    ],
    'body_options' => 'hold-transition sidebar-mini layout-fixed',
    'body_content' => $main_template
]);