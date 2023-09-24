<?php

require_once '../config/config.php';
date_default_timezone_set(Config::TimeZone);
session_start();

#error_reporting(0);
#ini_set('display_errors', 0);

$is_IM = include '../config/connect.php';
 
if ($is_IM->INSTALL_MODE) {
    header("Refresh:0; url=install.php");
} elseif (isset($_COOKIE['Session']) && !isset($_SESSION['admin'])) {
    require_once "controllers/controller_login.php";
    $phpinput = file_get_contents('php://input');
    $data = ($phpinput != NULL) ? json_decode($phpinput)->data : '';
    $index = new Controller_Login($data);
    $_SESSION['admin'] = $index->check_login_session($_COOKIE['Session']);
    if ($_SESSION['admin']) {
        $_SESSION['admin'] = json_encode(['message' => $_SESSION['admin']]);
        header("Location: " . Config::AdminRoot);
    } else {
        unset($_SESSION['admin']);
        setcookie('Session', null, -1, '/');
        unset($_COOKIE['Session']);
    }
}  elseif (!isset($_SESSION['admin']))  {
    require_once "controllers/controller_login.php";
    $phpinput = file_get_contents('php://input');
    $data = ($phpinput != NULL) ? json_decode($phpinput)->data : '';
    $index = new Controller_Login($data);
    $action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : 'show_login';
    if (is_callable([$index, $action])) {
        $index->$action();
    } else {
        $index->show_404();
    }
} else {
    require_once "controllers/controller_admin.php";
    $phpinput = file_get_contents('php://input');
    $data = ($phpinput != NULL) ? json_decode($phpinput)->data : '';
    $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 1;
    $id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
    $index = new Controller_Admin($data, $page, $id);
    $action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : 'show_admin_dashboard';
    if (is_callable([$index, $action])) {
        $index->$action();
    } else {
        $index->show_404();
    }
}

