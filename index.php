<?php

require 'helpers.php';

$projects = ['Вхідні', 'Навчання', 'Робота', 'Домашні справи', 'Авто'];
$tasks = [
    ['Завдання' => 'Співбесіда в ІТ компанії', 'Дата виконання' => '01.07.2023', 'Категорія' => 'Робота', 'Статус' => 'backlog'],
    ['Завдання' => 'Виконати тестове завдання', 'Дата виконання' => '25.07.2023', 'Категорія' => 'Робота', 'Статус' => 'backlog'],
    ['Завдання' => 'Зробити завдання до першого уроку', 'Дата виконання' => '27.04.2023', 'Категорія' => 'Навчання', 'Статус' => 'done'],
    ['Завдання' => 'Зустрітись с друзями', 'Дата виконання' => '14.05.2023', 'Категорія' => 'Вхідні', 'Статус' => 'to-do'],
    ['Завдання' => 'Купити корм для кота', 'Дата виконання' => NULL, 'Категорія' => 'Домашні справи', 'Статус' => 'in-progress'],
    ['Завдання' => 'Замовити піцу', 'Дата виконання' => NULL, 'Категорія' => 'Домашні справи', 'Статус' => 'to-do'],
];

function project_count($all_tasks, $project): int {
    $count = 0;

    foreach ($all_tasks as $key => $value) {
        if ($project == $value['Категорія']) {
            $count++;
        }
    }

    return $count;
}

$kanban_template = renderTemplate('kanban.php', ['tasks' => $tasks]);

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