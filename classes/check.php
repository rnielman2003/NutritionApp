<?php

require 'db.php';

class Membership {
	
	function validate_user($un, $pwd) {
		$mysql = new mysql();
		$get_the_user_id = $mysql->verify_User($un, md5($pwd));
		$is_also_admin = $mysql->is_Admin($un, md5($pwd));
		if($is_also_admin) {
			session_start();
			$_SESSION['status'] = 'authorized';
			$_SESSION['admin'] = 'true';
			header("location: admin.php");
		}else if($get_the_user_id) {
			session_start();
			$_SESSION['id'] = $get_the_user_id;
			$_SESSION['status'] = 'authorized';
			header("location: enter.php");
		} else return "Please enter a correct username and password";
	} 
	
	function create_User($un, $pwd, $first, $last) {
		$mysql = new mysql();
		$register = $mysql->make_User($un, md5($pwd), $first, $last);
		
		
		if($register) {
			header("location: login.php?reg=1");
		}
	}
	
	function log_User_Out() {
		session_start();
		if(isset($_SESSION['status'])) {
			unset($_SESSION['status']);
			
			if(isset($_SESSION['admin'])) {
				unset($_SESSION['admin']);
			}
			
			if(isset($_SESSION['id'])) {
				unset($_SESSION['id']);
			}
			
			if(isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '', time() - 1000);
				session_destroy();
			}
		}
	}
	
	function confirm_Member() {
		session_start();
		if($_SESSION['status'] !='authorized') header("location: login.php");
	}
	
	function confirm_Admin() {
		session_start();
		if($_SESSION['admin'] !='true') header("location: enter.php");
		if($_SESSION['status'] !='authorized') header("location: login.php");
	}
	
}