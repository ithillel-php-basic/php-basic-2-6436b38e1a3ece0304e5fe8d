<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($_COOKIE['error-action']) AND array_key_exists('error-action', $_COOKIE)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Помилка!</strong> <?= $_COOKIE['error-action'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Створити задачу</h1>
                </div>
                <div class="col-sm-6 d-none d-sm-block">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Створити задачу</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form action="add-task.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Основні</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Назва задачі</label>
                                <input type="text" id="inputName" name="inputName" class="form-control<?= (!empty($form_result['inputName-error']) ? ' is-invalid' : '') ?>" required>
                                <?= (!empty($form_result['inputName-error']) ? '<span id="inputName-error" class="error invalid-feedback">' . $form_result['inputName-error'] . '</span>' : '') ?>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Опис задачі</label>
                                <textarea id="inputDescription" name="inputDescription" class="form-control<?= (!empty($form_result['inputDescription-error']) ? ' is-invalid' : '') ?>" rows="4"></textarea>
                                <?= (!empty($form_result['inputDescription-error']) ? '<span id="inputDescription-error" class="error invalid-feedback">' . $form_result['inputDescription-error'] . '</span>' : '') ?>
                            </div>
                            <div class="form-group">
                                <label for="selectProject">Оберіть проект</label>
                                <select class="form-control<?= (!empty($form_result['selectProject-error']) ? ' is-invalid' : '') ?>" id="selectProject" name="selectProject" required>
                                    <option value="" disabled selected>Виберіть проект</option>
                                    <?php foreach ($projects as $key => $value): ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= (!empty($form_result['selectProject-error']) ? '<span id="selectProject-error" class="error invalid-feedback">' . $form_result['selectProject-error'] . '</span>' : '') ?>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Додаткові</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputDate">Дата виконання</label>
                                <input type="date" id="inputDate" name="inputDate" class="form-control<?= (!empty($form_result['inputDate-error']) ? ' is-invalid' : '') ?>" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" required>
                                <?= (!empty($form_result['inputDate-error']) ? '<span id="inputDate-error" class="error invalid-feedback">' . $form_result['inputDate-error'] . '</span>' : '') ?>
                            </div>
                            <div class="form-group">
                                <label for="inputTaskFile">Прикріпити файл</label>
                                <input type="file" id="inputTaskFile" name="inputTaskFile" class="form-control<?= (!empty($form_result['inputTaskFile-error']) ? ' is-invalid' : '') ?>">
                                <?= (!empty($form_result['inputTaskFile-error']) ? '<span id="inputTaskFile-error" class="error invalid-feedback">' . $form_result['inputTaskFile-error'] . '</span>' : '') ?>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="/" class="btn btn-secondary">Відмініти</a>
                    <input type="submit" value="Створити нову задачу" class="btn btn-success">
                </div>
            </div>
        </form>
    </section>
</div>