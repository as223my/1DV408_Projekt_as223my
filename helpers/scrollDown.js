"use strict";

var scrollDown = {
		
	init:function(){
 
		var objDiv = document.getElementById("messageDiv");
		objDiv.scrollTop = objDiv.scrollHeight;	
	}
	
}; 

window.onload = scrollDown.init;