<?php
include 'config.php';
const APP_VERSION = '0.1.11';
const USERNAME = 'Daniil Ivanov';
const USERID = 1;

/**
 * Перевіряє передану дату на відповідність формату 'ГГГГ-ММ-ДД'
 *
 * Приклади використання:
 * isDateValid('2019-01-01'); // true
 * isDateValid('2016-02-29'); // true
 * isDateValid('2019-04-31'); // false
 * isDateValid('10.10.2010'); // false
 * isDateValid('10/10/2010'); // false
 *
 * @param string $date Дата у вигляді рядка
 *
 * @return bool true у разі збігу з форматом 'ГГГГ-ММ-ДД', інакше false
 */
function isDateValid(string $date) : bool {
    $format_to_check = 'Y-m-d';
    $dateTimeObj = date_create_from_format($format_to_check, $date);

    return $dateTimeObj !== false && array_sum(date_get_last_errors()) === 0;
}

/**
 * Створює підготовлений вираз на основі готового SQL запиту і переданих даних
 *
 * @param $link mysqli Ресурс з'єднання
 * @param $sql string SQL запит із плейсхолдерами замість значень
 * @param array $data Дані для вставки на місце плейсхолдерів
 *
 * @return mysqli_stmt Підготовлений вираз
 */
function dbGetPrepareStmt($link, $sql, $data = []) {
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        $errorMsg = 'Не вдалося ініціалізувати підготовлений вираз: ' . mysqli_error($link);
        throw new ErrorException($errorMsg);
    }

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = 's';

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);

        if (mysqli_errno($link) > 0) {
            $errorMsg = 'Не вдалося пов\'язати підготовлений вираз із параметрами: ' . mysqli_error($link);
            throw new ErrorException($errorMsg);
        }
    }

    return $stmt;
}

/**
 * Повертає коректну форму множини
 * Обмеження: тільки для цілих чисел
 *
 * Приклад використання:
 * $remainingMinutes = 5;
 * echo "Я поставив таймер на {$remainingMinutes} " .
 *     getNounPluralForm(
 *         $remainingMinutes,
 *         'хвилина',
 *         'хвилини',
 *         'хвилин'
 *     );
 * Результат: "Я поставив таймер на 5 хвилин"
 *
 * @param int $number Число, за яким обчислюємо форму множини
 * @param string $one Форма однини: яблуко, година, хвилина
 * @param string $two Форма множини для 2, 3, 4: яблука, години, хвилини
 * @param string $many Форма множини для решти чисел
 *
 * @return string Розрахована форма множини
 */
function getNounPluralForm (int $number, string $one, string $two, string $many): string
{
    $number = (int) $number;
    $mod10 = $number % 10;
    $mod100 = $number % 100;

    switch (true) {
        case ($mod100 >= 11 && $mod100 <= 20):
            return $many;

        case ($mod10 > 5):
            return $many;

        case ($mod10 === 1):
            return $one;

        case ($mod10 >= 2 && $mod10 <= 4):
            return $two;

        default:
            return $many;
    }
}

/**
 * Підключає шаблон, передає туди дані і повертає підсумковий HTML контент
 *
 * @param string $name Шлях до файлу шаблону відносно папки templates
 * @param array $data Асоціативний масив із даними для шаблону
 * @return string Підсумковий HTML
 */
function renderTemplate($name, array $data = []) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

/**
 * Connect to DB
 * @return mysqli|false
 */
function connect_to_mysql_db(): mysqli|false {
    mysqli_report(MYSQLI_REPORT_OFF);

    $db = mysqli_connect($_ENV['hostname'], $_ENV['username'], $_ENV['password'], $_ENV['database']);
    if (!$db) {
        die('Field to connect to DB');
    }
    mysqli_set_charset($db, 'utf8mb4');

    return $db;
}

/**
 * Get file extension
 *
 * @param $string
 * @return string
 */
function get_file_extension($string): string {
    $string = implode("",explode("\\", $string));
    $string = explode(".", $string);
    $string = strtolower(end($string));
    return $string;
}

/**
 * Get all projects or projects for USERID
 *
 * @param object $db
 * @param bool $for_user
 * @return array|bool
 */
function get_projects(object $db, bool $for_user = false): array|bool {
    $query = "SELECT p.*, COUNT(t.id) AS tcount FROM projects AS p LEFT JOIN tasks AS t ON p.id = t.project_id GROUP BY p.id";
    if ($for_user) {
        $query = sprintf("SELECT p.*, COUNT(t.id) AS tcount FROM projects AS p LEFT JOIN tasks AS t ON p.id = t.project_id WHERE p.user_id = '%d' GROUP BY p.id;", USERID);
    }

    $make_query = mysqli_query($db, $query);
    return $make_query ? mysqli_fetch_all($make_query, MYSQLI_ASSOC) : false;
}

/**
 * Get Project name from get_projects()
 *
 * @param array $all_projects
 * @param bool $project_id
 * @param bool $breadcrumb
 * @return string|null
 */
function get_project_name(array $all_projects, bool $project_id = false, bool $breadcrumb = false): string|null {
    if ($project_id) {
        $pid = (is_numeric($_GET['project']) ? intval($_GET['project']) - 1 : false);
        if ($pid AND $pid <= count($all_projects)) {
            if (isset($all_projects[$pid]['name']) AND $breadcrumb) {
                return '<a href="/">Всі проекти</a> / ' . $all_projects[$pid]['name'];
            } elseif (isset($all_projects[$pid]['name'])) {
                return $all_projects[$pid]['name'];
            } else {
                return null;
            }
        } else {
            return null;
        }
    } elseif (!$breadcrumb) {
        return 'Всі проекти';
    } else {
        return null;
    }
}

/**
 * Check project unique on database
 *
 * @param array $projects
 * @param string $project_id
 * @return bool
 */
function check_project_unique(array $projects, string $project_id): bool {
    foreach ($projects as $project) {
        if ($project['id'] == $project_id) {
            return true;
        }
    }
    return false;
}

/**
 * Get all tasks or tasks for USERID or for USERID with Project ID
 *
 * @param object $db
 * @param bool $for_user
 * @param int|string|float|null $project_id
 * @return array|bool
 */
function get_tasks(object $db, bool $for_user = false, int|string|float $project_id = null): array|bool {
    $query = "SELECT * FROM tasks";
    if ($for_user AND !is_null($project_id) AND is_numeric($project_id)) {
        $query = sprintf("SELECT * FROM tasks WHERE user_id = '%d' AND project_id = '%u'", USERID, intval($project_id));
    } elseif ($for_user) {
        $query = sprintf("SELECT * FROM tasks WHERE user_id = '%d'", USERID);
    } else {
        return false;
    }

    $make_query = mysqli_query($db, $query);
    return $make_query ? mysqli_fetch_all($make_query, MYSQLI_ASSOC) : false;
}

/**
 * Generate task timer in badge
 *
 * @param string $task_date
 * @return string
 */
function task_timer(string $task_date): string {
    $task_time = strtotime($task_date);
    $hours = ($task_time / 3600) - (time() / 3600);

    if (isDateValid($task_date)) {
        if (($hours <= 24)) {
            return "<small class=\"badge badge-danger\"><i class=\"far fa-clock\"></i> " . htmlspecialchars($task_date . " (" . max(floor($hours), 0) . " год.)") . "</small>";
        } else {
            return "<small class=\"badge badge-success\"><i class=\"far fa-clock\"></i> " . htmlspecialchars($task_date . " (" . floor($hours / 24) . " д.)") . "</small>";
        }
    }

    return false;
}

/**
 * @param array $data
 * @param array $projects
 * @return bool|array
 */
function check_add_task_from(array $data, array $projects): bool|array {
    $error = [];
    $file_name_to_upload = '';
    if (!empty($data['POST']['inputName'])) {
        if (!preg_match('/^([a-zA-Zа-яА-Я0-9_.!?\\s]{3,})$/', $data['POST']['inputName'])) {
            $error['inputName-error'] = 'Мінімальна довжина назви 3 символи, або присутні неприпустимі символи';
        }
    } else $error['inputName-error'] = 'Це поле обов\'язкове';
    if (!empty($data['POST']['inputDescription'])) {
        if (!preg_match('/^(?=.{3,255}$)[\w\W]+$/', $data['POST']['inputDescription'])) {
            $error['inputDescription-error'] = 'Мінімальна довжина опису 3 символа, максимальна довжина опису 255 символів, або присутні неприпустимі символи';
        }
    }
    if (!empty($data['POST']['selectProject'])) {
        if (!check_project_unique($projects, $data['POST']['selectProject'])) {
            $error['selectProject-error'] = 'Вказаний ID проекту не знайдено в базі даних';
        }
    } else $error['selectProject-error'] = 'Це поле обов\'язкове';
    if (!empty($data['POST']['inputDate'])) {
        if (isDateValid($data['POST']['inputDate'])) {
            if (strtotime($data['POST']['inputDate']) < strtotime(date('Y-m-d'))) {
                $error['inputDate-error'] = 'Дата завдання не може бути вчорашньою або пізніше';
            }
        } else $error['inputDate-error'] = 'Невірний формат дати';
    }
    if (!empty($data['FILE']['inputTaskFile'])) {
        if ($data['FILE']['inputTaskFile']['error'] === UPLOAD_ERR_OK) {
            $acceptable_types = array(
                'application/pdf',
                'image/jpeg',
                'image/jpg',
                'image/gif',
                'image/png'
            );
            $file_name = $data['FILE']['inputTaskFile']['name'];
            $temp_file_path = $data['FILE']['inputTaskFile']['tmp_name'];
            $file_extension = get_file_extension($file_name);
            $file_name_to_upload = md5(uniqid(rand(), true)) . '.' . $file_extension;

            if(in_array($data['FILE']['inputTaskFile']['type'], $acceptable_types) && !empty($data['FILE']['inputTaskFile']['type'])) {
                if (!is_dir(__DIR__ . '/storage/tasks-files')) {
                    if (!mkdir(__DIR__ . '/storage/tasks-files', 0770, true)) {
                        $error['inputTaskFile-error'] = 'Виникла помилка при завантаженні файлу';
                    }
                }
                if (!move_uploaded_file($temp_file_path, 'storage/tasks-files/' . $file_name_to_upload)){
                    $error['inputTaskFile-error'] = 'Виникла помилка при завантаженні файлу';
                }
            } else $error['inputTaskFile-error'] = 'Файл непідримуваного типу';
        } elseif ($data['FILE']['inputTaskFile']['error'] === UPLOAD_ERR_NO_FILE) {
            $data['FILE']['inputTaskFile'] = null;
        } else $error['inputTaskFile-error'] = 'Виникла помилка при завантаженні файлу';
    }

    if (empty($error)) return ['status' => 'success', 'data' => $file_name_to_upload]; else return ['status' => 'error', 'data' => $error];
}

function create_task(object $db, array $data, string $file_name): bool {
    $query = '';
    if (empty($data['FILE']['inputTaskFile']['name'])) {
        $query = sprintf("INSERT INTO `tasks`(`project_id`, `user_id`, `name`, `description`, `deadline`) VALUES ('%s','%d','%s','%s','%s')",
            $data['POST']['selectProject'],
            USERID,
            $data['POST']['inputName'],
            $data['POST']['inputDescription'],
            $data['POST']['inputDate']
        );
    } else {
        $query = sprintf("INSERT INTO `tasks`(`project_id`, `user_id`, `name`, `description`, `deadline`, `file`) VALUES ('%s','%d','%s','%s','%s','%s')",
            $data['POST']['selectProject'],
            USERID,
            $data['POST']['inputName'],
            $data['POST']['inputDescription'],
            $data['POST']['inputDate'],
            $file_name
        );
    }
    $make_query = mysqli_query($db, $query);
    return $make_query ? true : false;
}