<?php
	require_once 'includes/constants.php';
	$db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

	
	if(!$db) {

		echo 'ERROR: Could not connect to the database.';
	} else {

		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			
			
			if(strlen($queryString) >0) {
				
				$query = $db->query("SELECT NDB_No, Shrt_Desc, GmWt_Desc1 FROM food_table WHERE Shrt_Desc LIKE '$queryString%' LIMIT 10");
				
				if($query) {
					// While there are results loop through them
					while ($result = $query ->fetch_object()) {
	         			echo '<li onClick="fill(\''.ucwords(strtolower($result->Shrt_Desc)).'\',\''.$result->NDB_No.'\',\''.$result->GmWt_Desc1.'\')">'.ucwords(strtolower($result->Shrt_Desc)).'</li>';
	         		}
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			} else {
			} 
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>