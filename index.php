<?php

require 'helpers.php';

/** @var TYPE_NAME $projects */
$projects = ['Вхідні', 'Навчання', 'Робота', 'Домашні справи', 'Авто'];
/** @var TYPE_NAME $tasks */
$tasks = [
    ['Завдання' => 'Співбесіда в ІТ компанії', 'Дата виконання' => '01.07.2023', 'Категорія' => 'Робота', 'Статус' => 'backlog'],
    ['Завдання' => 'Виконати тестове завдання', 'Дата виконання' => '25.07.2023', 'Категорія' => 'Робота', 'Статус' => 'backlog'],
    ['Завдання' => 'Зробити завдання до першого уроку', 'Дата виконання' => '27.04.2023', 'Категорія' => 'Навчання', 'Статус' => 'done'],
    ['Завдання' => 'Зустрітись с друзями', 'Дата виконання' => '', 'Категорія' => 'Вхідні', 'Статус' => 'to-do'],
    ['Завдання' => 'Купити корм для кота', 'Дата виконання' => '11.05.2023', 'Категорія' => 'Домашні справи', 'Статус' => 'in-progress'],
    ['Завдання' => 'Замовити піцу', 'Дата виконання' => NULL, 'Категорія' => 'Домашні справи', 'Статус' => 'to-do'],
];

/**
 * @param $all_tasks
 * @param $project
 * @return int
 */
function project_count($all_tasks, $project): int {
    $count = 0;

    foreach ($all_tasks as $key => $value) {
        if ($project == $value['Категорія']) {
            $count++;
        }
    }

    return $count;
}

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
function validate_date($date, $format = 'd.m.Y'): bool {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

/** @var TYPE_NAME $kanban_template */
$kanban_template = renderTemplate('kanban.php', ['tasks' => $tasks]);

/** @var TYPE_NAME $main_template */
$main_template = renderTemplate('main.php', [
    'wrapper_content' => $kanban_template,
    'user_name' => 'Daniil Ivanov',
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