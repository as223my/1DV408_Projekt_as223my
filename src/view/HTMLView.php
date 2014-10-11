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
					<meta charset=utf-8>
				</head>
				<body>
					 $body
				</body>
			</html>";
	}
}