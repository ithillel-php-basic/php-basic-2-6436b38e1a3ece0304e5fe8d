<div class="content-wrapper kanban">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1><?= (!is_null($project_title) ? $project_title !== '' ? $project_title[0] : 'Всі проекти' : '') ?></h1>
                </div>
                <div class="col-sm-6 d-none d-sm-block">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><?= (!is_null($project_title) ? $project_title !== '' ? '<a href="/">Всі проекти</a> / ' . $project_title[0] : '' : '') ?></li>
                    </ol>
                </div>
            </div>
            <?php if ($tasks AND count($tasks) !== 0): ?>
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <div class="row">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <a type="button" href="#" class="btn btn-secondary active">Усі завдання</a>
                                <a type="button" href="#" class="btn btn-default">Порядок денний</a>
                                <a type="button" href="#" class="btn btn-default">Завтра</a>
                                <a type="button" href="#" class="btn btn-default">Прострочені</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php if ($tasks AND count($tasks) !== 0): ?>
        <section class="content pb-3">
            <div class="container-fluid h-100">
                <div class="card card-row card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Беклог
                        </h3>
                    </div>
                    <div class="card-body connectedSortable" data-status="backlog">
                        <?php foreach ($tasks as $key => $value): ?>
                            <?php if ($value['status'] === 'backlog'): ?>
                                <div class="card card-info card-outline" data-task-id="<?= $key++ ?>">
                                    <div class="card-header">
                                        <h5 class="card-title"><?= htmlspecialchars($value['name']) ?></h5>
                                        <div class="card-tools">
                                            <a href="#" class="btn btn-tool btn-link">#<?= $key++ ?></a>
                                            <a href="#" class="btn btn-tool">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php if (!empty($value['description'])): ?>
                                            <p><?= $value['description'] ?></p>
                                        <?php endif; ?>
                                        <a href="#" class="btn btn-tool">
                                            <i class="fas fa-file"></i>
                                        </a>
                                        <?php if (!empty($value['deadline'])): ?>
                                            <?= task_timer($value['deadline']) ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="card card-row card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Зробити
                        </h3>
                    </div>
                    <div class="card-body connectedSortable" data-status="to-do">
                        <?php foreach ($tasks as $key => $value): ?>
                            <?php if ($value['status'] === 'to-do'): ?>
                                <div class="card card-info card-outline" data-task-id="<?= $key++ ?>">
                                    <div class="card-header">
                                        <h5 class="card-title"><?= htmlspecialchars($value['name']) ?></h5>
                                        <div class="card-tools">
                                            <a href="#" class="btn btn-tool btn-link">#<?= $key++ ?></a>
                                            <a href="#" class="btn btn-tool">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php if (!empty($value['description'])): ?>
                                            <p><?= $value['description'] ?></p>
                                        <?php endif; ?>
                                        <a href="#" class="btn btn-tool">
                                            <i class="fas fa-file"></i>
                                        </a>
                                        <?php if (!empty($value['deadline'])): ?>
                                            <?= task_timer($value['deadline']) ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="card card-row card-default">
                    <div class="card-header bg-info">
                        <h3 class="card-title">
                            В процесі
                        </h3>
                    </div>
                    <div class="card-body connectedSortable" data-status="in-progress">
                        <?php foreach ($tasks as $key => $value): ?>
                            <?php if ($value['status'] === 'in-progress'): ?>
                                <div class="card card-info card-outline" data-task-id="<?= $key++ ?>">
                                    <div class="card-header">
                                        <h5 class="card-title"><?= htmlspecialchars($value['name']) ?></h5>
                                        <div class="card-tools">
                                            <a href="#" class="btn btn-tool btn-link">#<?= $key++ ?></a>
                                            <a href="#" class="btn btn-tool">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php if (!empty($value['description'])): ?>
                                            <p><?= $value['description'] ?></p>
                                        <?php endif; ?>
                                        <a href="#" class="btn btn-tool">
                                            <i class="fas fa-file"></i>
                                        </a>
                                        <?php if (!empty($value['deadline'])): ?>
                                            <?= task_timer($value['deadline']) ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="card card-row card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            Готово
                        </h3>
                    </div>
                    <div class="card-body connectedSortable" data-status="done">
                        <?php foreach ($tasks as $key => $value): ?>
                            <?php if ($value['status'] === 'done'): ?>
                                <div class="card card-info card-outline" data-task-id="<?= $key++ ?>">
                                    <div class="card-header">
                                        <h5 class="card-title"><?= htmlspecialchars($value['name']) ?></h5>
                                        <div class="card-tools">
                                            <a href="#" class="btn btn-tool btn-link">#<?= $key++ ?></a>
                                            <a href="#" class="btn btn-tool">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php if (!empty($value['description'])): ?>
                                            <p><?= $value['description'] ?></p>
                                        <?php endif; ?>
                                        <a href="#" class="btn btn-tool">
                                            <i class="fas fa-file"></i>
                                        </a>
                                        <?php if (!empty($value['deadline'])): ?>
                                            <?= task_timer($value['deadline']) ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>
        <section class="content pb-3 d-flex align-items-center">
            <div class="container-fluid">
                <?= (!is_null($project_title) ? '<span class="text-muted">У базі данних не знайдено жодного завдання за вказаним проектом</span>' : '<span class="text-muted">Вказаного ID проекту не знайдено у базі данних</span>') ?>
            </div>
        </section>
    <?php endif; ?>
</div>