<?php

class Admin_tasks {
	
	function user_List() {
		$mysql = new mysql();
		$register = $mysql->get_Userlist();

		if($register) {
			return $register;
		}
	}
	function list_user_Menu($userid) {
		$mysql = new mysql();
		$register = $mysql->get_Usermenu($userid);

		if($register) {
			return $register;
		}
	}
	function getName($userid) {
		$mysql = new mysql();
		$register = $mysql->get_Username($userid);

		if($register) {
			return $register;
		}
	}
	
	
	
}