<?php
require_once("src/view/HTMLView.php");
require_once("src/controller/c_navigation.php");
	
$view = new \view\HTMLView();

$navigation = new \controller\Navigation();

$html = $navigation->doControll();

$view->echoHTML($html);
