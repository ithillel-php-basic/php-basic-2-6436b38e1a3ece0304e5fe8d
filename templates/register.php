<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="/" class="h1">Завдання та проекти</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Зареєструватися</p>

            <form action="/register.php" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="inputName" class="form-control<?= (!empty($form_result['inputName-error']) ? ' is-invalid' : '') ?>" placeholder="Повне ім'я" <?= (!empty($form_data['inputName']) ? 'value="' . $form_data['inputName'] . '"' : '') ?> required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <?= (!empty($form_result['inputName-error']) ? '<span id="inputName-error" class="error invalid-feedback">' . $form_result['inputName-error'] . '</span>' : '') ?>
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="inputEmail" class="form-control<?= (!empty($form_result['inputEmail-error']) ? ' is-invalid' : '') ?>" placeholder="Email" <?= (!empty($form_data['inputEmail']) ? 'value="' . $form_data['inputEmail'] . '"' : '') ?> required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <?= (!empty($form_result['inputEmail-error']) ? '<span id="inputEmail-error" class="error invalid-feedback">' . $form_result['inputEmail-error'] . '</span>' : '') ?>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="inputPassword" class="form-control<?= (!empty($form_result['inputPassword-error']) ? ' is-invalid' : '') ?>" placeholder="Пароль" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <?= (!empty($form_result['inputPassword-error']) ? '<span id="inputPassword-error" class="error invalid-feedback">' . $form_result['inputPassword-error'] . '</span>' : '') ?>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="inputRepeatPassword" class="form-control<?= (!empty($form_result['inputRepeatPassword-error']) ? ' is-invalid' : '') ?>" placeholder="Повторіть пароль" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <?= (!empty($form_result['inputRepeatPassword-error']) ? '<span id="inputRepeatPassword-error" class="error invalid-feedback">' . $form_result['inputRepeatPassword-error'] . '</span>' : '') ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="icheck-primary">
                            <input class="<?= (!empty($form_result['checkTerms-error']) ? ' is-invalid' : '') ?>" type="checkbox" id="agreeTerms" name="checkTerms" value="agree" required>
                            <label for="agreeTerms">
                                Я згоден(а) з <a href="#">умовами</a>
                            </label>
                            <?= (!empty($form_result['checkTerms-error']) ? '<span id="checkTerms-error" class="error invalid-feedback">' . $form_result['checkTerms-error'] . '</span>' : '') ?>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-8 offset-2">
                        <button type="submit" class="btn btn-primary btn-block">Зареєструватися</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="/login.php" class="text-center">В мене вже є аккаунт</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
