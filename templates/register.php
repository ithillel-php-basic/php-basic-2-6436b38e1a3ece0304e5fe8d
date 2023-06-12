<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="/" class="h1">Завдання та проекти</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Зареєструватися</p>

            <form action="/register.php" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="inputName" class="form-control<?= (isset($_SESSION['inputName-error']) ? ' is-invalid' : '') ?>" placeholder="Повне ім'я" <?= ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['inputName']) ? 'value="' . $_POST['inputName'] . '"' : '') ?> required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <?= (isset($_SESSION['inputName-error']) ? '<span id="inputName-error" class="error invalid-feedback">' . $_SESSION['inputName-error'] . '</span>' : '') ?>
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="inputEmail" class="form-control<?= (isset($_SESSION['inputEmail-error']) ? ' is-invalid' : '') ?>" placeholder="Email" <?= ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['inputEmail']) ? 'value="' . $_POST['inputEmail'] . '"' : '') ?> required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <?= (isset($_SESSION['inputEmail-error']) ? '<span id="inputEmail-error" class="error invalid-feedback">' . $_SESSION['inputEmail-error'] . '</span>' : '') ?>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="inputPassword" class="form-control<?= (isset($_SESSION['inputPassword-error']) ? ' is-invalid' : '') ?>" placeholder="Пароль" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <?= (isset($_SESSION['inputPassword-error']) ? '<span id="inputPassword-error" class="error invalid-feedback">' . $_SESSION['inputPassword-error'] . '</span>' : '') ?>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="inputRepeatPassword" class="form-control<?= (isset($_SESSION['inputRepeatPassword-error']) ? ' is-invalid' : '') ?>" placeholder="Повторіть пароль" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <?= (isset($_SESSION['inputRepeatPassword-error']) ? '<span id="inputRepeatPassword-error" class="error invalid-feedback">' . $_SESSION['inputRepeatPassword-error'] . '</span>' : '') ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="icheck-primary">
                            <input class="<?= (isset($_SESSION['checkTerms-error']) ? ' is-invalid' : '') ?>" type="checkbox" id="agreeTerms" name="checkTerms" value="agree" required>
                            <label for="agreeTerms">
                                Я згоден(а) з <a href="#">умовами</a>
                            </label>
                            <?= (isset($_SESSION['checkTerms-error']) ? '<span id="checkTerms-error" class="error invalid-feedback">' . $_SESSION['checkTerms-error'] . '</span>' : '') ?>
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
