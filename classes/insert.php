<?php

class InsertRecords {
	
	function insert_Items($id, $userid, $fid, $amt, $day) {
		$mysql = new mysql();
		$register = $mysql->insert_Food($id, $userid, $fid, $amt, $day);
		
		
		if($register) {
			//send them to next day
			if($day == '1') {header("location: enter.php?d=2");}
			if($day == '2') {header("location: enter.php?d=3");}
			if($day == '3') {header("location: enter.php?d=fin");}
		}
	}
	
	
	
}