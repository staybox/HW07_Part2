<?php
namespace App\Controllers;

use App\Core\View;

class MainController
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function user()
    {
        $user = null;

        if (!empty($_SESSION["user"])) {
            $user = $_SESSION["user"];
        }

        return $user;
    }
}
