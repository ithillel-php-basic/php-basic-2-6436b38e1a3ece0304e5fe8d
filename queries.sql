-- Creating users
INSERT INTO `users` (`id`, `email`, `password`, `username`)
VALUES
    (1, 'iva.dan.den@gmail.com', '$2y$10$.Osr2.gPLGqwZ86Jyj9yYusc2zgzO0LuyNsj5iI/JCIH/qKeelvi6', 'Daniil Ivanov'),
    (2, 'mail@roffdaniel.com', '$2y$10$Fd2UGRWZqtKIgnAusGPo6uyqGabL7WX5qXgcBe9Hup9BiWldQizzC', 'RoffDaniel');

-- Creating projects
INSERT INTO `projects` (`id`, `user_id`, `name`)
VALUES
    (1, 1, 'Вхідні'),
    (2, 1, 'Навчання'),
    (3, 1, 'Робота'),
    (4, 1, 'Домашні справи'),
    (5, 1, 'Авто');

-- Creating tasks
INSERT INTO `tasks` (`id`, `project_id`, `user_id`, `name`, `description`, `deadline`, `status`, `file`)
VALUES
    (1, 3, 1, 'Співбесіда в ІТ компанії', NULL, '2023-07-01', 'backlog', NULL),
    (2, 3, 1, 'Виконати тестове завдання', NULL, '2023-07-23', 'backlog', NULL),
    (3, 2, 1, 'Зробити завдання до першого уроку', NULL, '2023-04-27', 'done', NULL),
    (4, 1, 1, 'Зустрітись с друзями', NULL, NULL, 'to-do', NULL),
    (5, 4, 1, 'Купити корм для кота', NULL, '2023-05-11', 'in-progress', NULL),
    (6, 4, 1, 'Замовити піцу', NULL, NULL, 'to-do', NULL);

-- Selecting all data from projects where username = Daniil Ivanov
SELECT p.*, u.username FROM projects AS p LEFT JOIN users AS u ON p.user_id = u.id WHERE u.username = 'Daniil Ivanov';

-- Selecting all data from tasks where project name = Домашні справи
SELECT t.*, p.name FROM tasks AS t LEFT JOIN projects AS p ON t.project_id = p.id WHERE p.name = 'Домашні справи';

-- Change task status on 'in-progress' by id 4
UPDATE `tasks` SET `status` = 'in-progress' WHERE `id` = 4;

-- Change task status on 'done' by id 5
UPDATE `tasks` SET `status` = 'done' WHERE `id` = 5;

-- Update task name by id 8
UPDATE `tasks` SET `name` = 'Купити корм для собаки' WHERE `id` = 8;
