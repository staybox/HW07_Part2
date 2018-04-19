<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends MainController
{
    public function index()
    {
        // Вывод сообщения если пользователя нет в базе данных
        if (!empty($_GET['error']))
        {
            $array = [
                'error' => "Такого пользователя нет в базе данных, зарегистрируйтесь"
            ];
        }else {
            $array = [
                'error' => null
            ];
        }
        $currentPage = $_SERVER['REQUEST_URI'];
        if (!empty($this->user())) {
            header("Location: /filelist.php");

        }

        $this->view->render('home', ['error' => $array], $currentPage);
    }

    public function edit($userId)
    {
        $userModel = new User();
        $user = $userModel->getUserById($userId);
        //var_dump($user);

        $this->view->render('edit', ['user' => $user]);

    }

    public function update(array $data)
    {
        if (empty($data['login']) || empty($data['password'])) {
            echo "Ошибка, не указан логин или пароль";
            return 0;
        }
        if ($data['password'] != $data['confirm_password']) {
            echo "Пароли не совпадают";
            return 0;
        }

        if (empty($data['name']) || empty($data['desc']) || empty($data['age'] ) || empty($data['Email_Parse'] )) {
            echo "Не указано имя, возраст, email или описание";
            return 0;
        }

        $data['password'] = md5($_POST['password']);
        $data['confirm_password'] = md5($_POST['confirm_password']);
        // обновление базы
        if (file_exists($_FILES['userfile']['tmp_name'])) {
            $uploaddir = realpath(__DIR__ . "/../../upload");
            $uploadfile = $uploaddir . DIRECTORY_SEPARATOR . md5($_POST['login']);
            $status = move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
            if ($status) {
                $replace = "http://" . $_SERVER['SERVER_NAME'] . ":81/upload/" . md5($_POST['login']);
                $data['photo'] = $replace;
                $data['photo_name'] = md5($_POST['login']);
            }
        }

        $userModel = new User();
        $user = $userModel->UpdateUser($data['user_id'], $data);
        if ($user){
            header("Location: /list.php");
        }else{
            echo "Данные пользователя не были обновлены";
        }

        // редирект на список пользователей
    }

    public function checkAuth()
    {
        // Проверки на пустые поля
        if (empty($_POST['login']) || empty($_POST['password'])) {
            echo "Ошибка, не указан логин или пароль";
            return 0;
        }
        $model = new User();
        $data = ['login' => trim(strtoupper($_POST['login'])), 'password' => md5($_POST['password']),];

        $user = $model->auth($data['login'],$data['password']);

        if ($user === null) {
            header("Location: /?error=1");
            return 0;
        }
            $_SESSION['user'] = $data['login'];
            header("Location: /list.php");
            return 0;

    }

    public function reg()
    {
        $currentPage = $_SERVER['REQUEST_URI'];
        if (!empty($_SESSION['user'])) {
            header("Location: /filelist.php");
        }
        $this->view->render('reg', [], $currentPage);
    }


    public function list()
    {
        if ($this->user() === null) {
            header("Location: /");
        }

        $currentPage = $_SERVER['REQUEST_URI'];
        // Обработка из базы данных в массив
        $userModel = new User();
        $users = $userModel->getAllUsers();
        // Рендер страницы и передача туда массива из базы данных
        $this->view->render('list', ['users' => $users], $currentPage);
    }

    public function filelist()
    {
        if (empty($this->user())) {
            header("Location: /");
            return 0;
        }

        $currentPage = $_SERVER['REQUEST_URI'];
        $modelShowFiles = new User();
        $modelfiles = $modelShowFiles->getFiles();

        $this->view->render('filelist', ['modelfiles' => $modelfiles], $currentPage);
    }

    public function removeImage()
    {
        $userModel = new User();
        $userModel->removePic($_GET['remove_userpic']);
        //var_dump($userModel);
        //exit();
        header("Location: /filelist.php");
    }

    public function removeUser()
    {
        $userModel = new User();
        $remove = $userModel->removeUser($_GET['remove_user_id']);
        if ($remove == true) {
            header("Location: /list.php");
        } else {
            echo "Пользователь не был удален";
        }
    }


    public function registration()
    {
        // Проверки на пустые поля
        if (empty($_POST['login']) || empty($_POST['password'])) {
            echo "Ошибка, не указан логин или пароль";
            return 0;
        }
        if ($_POST['password'] != $_POST['confirm_password']) {
            echo "Пароли не совпадают";
            return 0;
        }

        if (empty($_POST['name']) || empty($_POST['desc']) || empty($_POST['age'])) {
            echo "Не указано имя, возраст или описание";
            return 0;
        }


        $login = trim(strtoupper($_POST['login']));
        $model = new User();
        $user = $model->getUserByLogin($login);

        if ($user !== null) {
            echo "Пользователь с логином " . $login . " существует";
            return 0;
        }

        $data = ['login' => $login, 'password' => md5($_POST['password']), 'name' => $_POST['name'], 'age' => $_POST['age'], 'desc' => $_POST['desc'], 'photo' => null, 'photo_name' => null];

        if (file_exists($_FILES['userfile']['tmp_name'])) {
            $uploaddir = realpath(__DIR__ . "/../../upload");
            $uploadfile = $uploaddir . DIRECTORY_SEPARATOR . md5($_POST['login']);
            $status = move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
            if ($status) {
                $replace = "http://" . $_SERVER['SERVER_NAME'] . ":81/upload/" . md5($_POST['login']);
                $data['photo'] = $replace;
                $data['photo_name'] = md5($_POST['login']);

                //$data['photo'] = $uploadfile;
            }
        }

        $model->CreateUser($data);
        $user = $model->getUserByLogin($login);

        if ($user === null) {
            echo "Не удалось записать в БД";
            return 0;
        }

        $_SESSION['user'] = $login;
        header("Location: /filelist.php");
    }
}
