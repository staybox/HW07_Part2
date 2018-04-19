<?php

namespace App\Core;

use App\Controllers\UserController;
use Illuminate\Database\Capsule\Manager as Capsule;

class Bootstrap
{
    public function __construct()
    {
        $this->initDb();
    }

    public function run()
    {
        if (!empty($_GET['logout'])) {
            $_SESSION["user"] = null;
            header("Location: /");
        }

// Отображение формы редактирования пользователя
        if (!empty($_GET['edit_user_id'])) {

            $controllers = new UserController();

            if (!empty($_FILES)) {
                // $controllers->update($_POST);
            }

            if (!empty($_POST)) {
                $controllers->update($_POST);
                return 0;
            }
            $controllers->edit($_GET['edit_user_id']);
            return 0;
        }

// Стартовая страница
        if ($_SERVER['REQUEST_URI'] == "/") {
            $controllers = new UserController();
            $controllers->index();
            return 0;
        }

        // Стартовая страница
        if (!empty($_GET['error'])) {
            $controllers = new UserController();
            $controllers->index();
            return 0;
        }

// Страница регистрации
        if ($_SERVER['REQUEST_URI'] == "/reg.php") {
            $controllers = new UserController();
            $controllers->reg();
            return 0;
        }

// Страница списка пользователей
        if ($_SERVER['REQUEST_URI'] == "/list.php") {

            $controllers = new UserController();
            $controllers->list();
            return 0;
        }

// Страница filelist
        if ($_SERVER['REQUEST_URI'] == "/filelist.php") {
            //$MainController = new MainController();
            //$MainController->user();
            $controllers = new UserController();
            $controllers->filelist();
            return 0;
        }

// Удаление картинки пользователя
        if (!empty($_GET['remove_userpic'])) {
            $controllers = new UserController();
            $controllers->removeImage();
            return 0;
        }

// Регистрация
        if ($_SERVER['REQUEST_URI'] == "/registration/add") {
            $controllers = new UserController();
            $controllers->registration();
            return 0;
        }

// Авторизация
        if ($_SERVER['REQUEST_URI'] == "/enter") {
            $controllers = new UserController();
            $controllers->checkAuth();
            return 0;
        }

// Удаление пользователя
        if (!empty($_GET['remove_user_id'])) {
            //var_dump("Удалить пользователя");
            $controllers = new UserController();
            $controllers->removeUser();
            return 0;
        }

    }

    protected function initDb()
    {
        $capsule = new Capsule;
        $capsule->addConnection(['driver' => 'mysql', 'host' => 'localhost', 'database' => 'dz7', 'username' => 'root', 'password' => '', 'charset' => 'utf8', 'collation' => 'utf8_unicode_ci', 'prefix' => '',]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}