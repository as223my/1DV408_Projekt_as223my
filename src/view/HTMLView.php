<?php
namespace view;

class HTMLView{

	public function echoHTML($body){
		
		if ($body === NULL) {
			throw new \Exception("HTMLView::echoHTML does not allow body to be NULL");
		}
		echo
			"<!DOCTYPE html>
			<html>
				<head>
					<title>FamilyBook</title>
					<link rel='stylesheet' type='text/css' href='css/style.css'>
					<link href='http://fonts.googleapis.com/css?family=Lora:700' rel='stylesheet' type='text/css'>
					<link href='http://fonts.googleapis.com/css?family=Dancing+Script:700' rel='stylesheet' type='text/css'>
				
					<meta charset=utf-8>
				</head>
				<body>
					 $body
					 
				<script src='helpers/scrollDown.js'></script>
				</body>
			</html>";
	}
}