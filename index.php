<?php

const USERNAME = 'Daniil Ivanov';
const USERID = 1;

require 'helpers.php';

/**
 * @return mysqli|false
 */
function connect_to_mysql_db(): mysqli|false {
    mysqli_report(MYSQLI_REPORT_OFF);

    $db = mysqli_connect('sql380.your-server.de', 'hillel', 'E1gQxarBwbpkdzgy', 'hillel_php_basic_daniil_ivanov');
    if (!$db) {
        die('Field to connect to DB');
    }
    mysqli_set_charset($db, 'utf8mb4');

    return $db;
}

$db = connect_to_mysql_db();

$projects_query = mysqli_query($db, sprintf("SELECT p.*, COUNT(t.id) AS tcount FROM projects AS p LEFT JOIN tasks AS t ON p.id = t.project_id WHERE p.user_id = '%d' GROUP BY p.id;", USERID));
$projects = $projects_query ? mysqli_fetch_all($projects_query, MYSQLI_ASSOC) : false;
$project_name = '';

if (!isset($_GET['project'])) {
    $task_query = mysqli_query($db, sprintf("SELECT * FROM tasks WHERE user_id = '%d'", USERID));
} else {
    $task_query = mysqli_query($db, sprintf("SELECT * FROM tasks WHERE user_id = '%d' AND project_id = '%u'", USERID, $_GET['project']));
    $project_name = mysqli_fetch_row(mysqli_query($db, sprintf("SELECT name FROM projects WHERE id = '%d'", $_GET['project'])));
}
$tasks = $task_query ? mysqli_fetch_all($task_query, MYSQLI_ASSOC) : false;

/**
 * @param int $time
 * @param string $task_date
 * @return string
 */
function task_timer(string $task_date): string {
    $task_time = strtotime($task_date);
    $hours = ($task_time / 3600) - (time() / 3600);

    if (validate_date($task_date)) {
        if (($hours <= 24)) {
            return "<small class=\"badge badge-danger\"><i class=\"far fa-clock\"></i> " . htmlspecialchars($task_date . " (" . max(floor($hours), 0) . " год.)") . "</small>";
        } else {
            return "<small class=\"badge badge-success\"><i class=\"far fa-clock\"></i> " . htmlspecialchars($task_date . " (" . floor($hours / 24) . " д.)") . "</small>";
        }
    }

    return false;
}

/**
 * @param $date
 * @param $format
 * @return bool
 */
function validate_date($date, $format = 'Y-m-d'): bool {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

/** @var TYPE_NAME $kanban_template */
$kanban_template = renderTemplate('kanban.php', ['tasks' => $tasks, 'project_title' => $project_name]);

/** @var TYPE_NAME $main_template */
$main_template = renderTemplate('main.php', [
    'wrapper_content' => $kanban_template,
    'user_name' => USERNAME . ' (ID: ' . USERID . ')',
    'user_photo' => 'https://en.gravatar.com/userimage/113651460/9f8c526466d42444c8a4d8d0b9bf1990.jpg?size=200',
    'projects' => $projects,
    'tasks' => $tasks
]);

print renderTemplate('layout.php',
    [
        'page_title' => 'Головна',
        'body_content' => $main_template
    ]
);