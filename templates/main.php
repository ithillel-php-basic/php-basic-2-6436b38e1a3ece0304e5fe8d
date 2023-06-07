<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Дошка</a>
            </li>
            <li class="nav-item bg-primary d-none d-sm-inline-block">
                <a href="/add-task.php" class="nav-link">Створити задачу</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link">
            <img src="static/img/logo.png" alt="Логотип Завдання та проекти" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Завдання та проекти</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?= htmlspecialchars($user_photo) ?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= htmlspecialchars($user_name) ?></a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="/" class="nav-link<?= (!isset($_GET['project']) ? ' active' : '') ?>">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Всі проекти
                                <?= !is_array($projects) ? '' : '<span class="badge badge-danger right">' . count($projects) . '</span>' ?>
                            </p>
                        </a>
                    </li>
                    <?php if ($projects): ?>
                        <?php foreach ($projects as $key => $value): ?>
                            <li class="nav-item">
                                <a href="/?project=<?= urlencode($value['id']) ?>" class="nav-link<?= ((isset($_GET['project']) AND ($_GET['project'] === $value['id'])) ? ' active' : '') ?>">
                                    <i class="nav-icon fas fa-columns"></i>
                                    <p>
                                        <?= htmlspecialchars($value['name']) ?>
                                        <span
                                            class="badge badge-info right"><?= htmlspecialchars($value['tcount']) ?></span>
                                    </p>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
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
        </div>
    </aside>

    <?= $wrapper_content ?>

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> <?= $app_version ?>
        </div>
        <strong>Copyright &copy; 2023 <a href="https://ithillel.ua/">Комп'ютерна школа Hillel</a>.</strong> All rights
        reserved.
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>
