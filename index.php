<?php

require_once 'config/config.php';
date_default_timezone_set(Config::TimeZone);
session_start();

require_once 'controllers/controller_visitor.php';
$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 1;
$search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
$index = new Controller_Visitor($id, $page, $search);
$action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : 'show_frontpage';
if (is_callable([$index, $action])) {
    $index->$action();
} else {
    $index->show_404();
}
