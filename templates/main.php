<?php

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

?>
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index.php" class="nav-link">Дошка</a>
            </li>
            <li class="nav-item bg-primary d-none d-sm-inline-block">
                <a href="index.php" class="nav-link">Створити задачу</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link">
            <img src="static/img/logo.png" alt="Логотип Завдання та проекти" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Завдання та проекти</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?= $user_photo ?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= $user_name ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <?php if ($user_name === 'Daniil Ivanov'): ?>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                           with font-awesome or any other icon font library -->
                        <?php foreach ($projects as $project_name): ?>
                            <li class="nav-item">
                                <a href="index.php" class="nav-link">
                                    <i class="nav-icon fas fa-columns"></i>
                                    <p>
                                        <?= $project_name ?>
                                        <span
                                            class="badge badge-info right"><?= project_count($tasks, $project_name) ?></span>
                                    </p>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <li class="nav-item">
                            <a href="index.php" class="nav-link bg-olive">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>
                                    Додати проект
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <?php if ($user_name === 'Daniil Ivanov'): ?>
        <?= renderTemplate($wrapper_content,
            [
                'tasks' => $tasks
            ]
        ) ?>
    <?php endif; ?>

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 0.1.0
        </div>
        <strong>Copyright &copy; 2023 <a href="https://ithillel.ua/">Комп'ютерна школа Hillel</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
