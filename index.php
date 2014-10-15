<?php
require_once("src/view/HTMLView.php");
require_once("src/controller/NavigationController.php");

session_start(); 

$view = new \view\HTMLView();

$navigation = new \controller\NavigationController();

$html = $navigation->doControll();

$view->echoHTML($html);
