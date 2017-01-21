<?php
require_once('includes/fb.php4');
require_once 'includes/constants.php';
ob_start();


class mysql {
	private $conn;
	
	function __construct() {
		$this->conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or 
					  die('There was a problem connecting to the database.');
	}
	
	function verify_User($un, $pwd) {
				
		$query = "SELECT id, username, password
				FROM users
				WHERE username = ? AND password = ?
				LIMIT 1";
				
		if($stmt = $this->conn->prepare($query)) {
			$stmt->bind_param('ss', $un, $pwd);
			$stmt->execute();
			
			/* bind variables to prepared statement */
			$stmt->bind_result($col1, $col2, $col3);
			
			/* fetch values */
			while ($stmt->fetch()) {
			return($col1);
			}
			
			//if($stmt->fetch()) {
			//	$stmt->close();
			//	return true;
			//}
			
		}	
	}
	function make_User($un, $pwd, $first, $last) {
				
		$query = "INSERT INTO users (username, password, firstname, lastname) VALUES (?,?,?,?)";
				
		if($stmt = $this->conn->prepare($query)) {
			$stmt->bind_param('ssss', $un, $pwd, $first, $last);
			$stmt->execute();

			if($stmt-affected_rows == 1) {  
				$stmt->close();
				return true;
			}
		}	
	}
	function insert_Food($id, $userid, $fid, $amt, $day) {

		$query = "INSERT INTO daily_entries (id, user_id, food_id, amount, day) VALUES (?,?,?,?,?)";
				
		if($stmt = $this->conn->prepare($query)) {
			$stmt->bind_param('sssss', $id, $userid, $fid, $amt, $day);
			$stmt->execute();

			if($stmt-affected_rows == 1) {  
				$stmt->close();
				return true;
			}
		}	
		
		
	}
	function is_Admin($un, $pwd) {
				
		$query = "SELECT *
				FROM users
				WHERE username = ? AND password = ? AND isadmin = 1
				LIMIT 1";
				
		if($stmt = $this->conn->prepare($query)) {
			$stmt->bind_param('ss', $un, $pwd);
			$stmt->execute();
			
			if($stmt->fetch()) {
				$stmt->close();
				return true;
			}
		}	
	}
	function get_Userlist() {
				
		$query = "SELECT id, firstname, lastname
				FROM users
				WHERE isadmin != 1";
				
		if($stmt = $this->conn->prepare($query)) {
			/* execute statement */
			$stmt->execute();
			
			/* bind variables to prepared statement */
			$stmt->bind_result($col1, $col2, $col3);
			
			/* fetch values */
			while ($stmt->fetch()) {
				printf ("<li><img src='images/person.png'><br/><h4>%s %s</h4><a href='menu.php?uid=%s'>View 3-Day Menu</a></li>", $col2, $col3, $col1);
			}
			$stmt->close();
		//end
		}
	}
	function get_Usermenu($userId) {

		

		$query = "SELECT food_table.Shrt_Desc, daily_entries.amount, food_table.Energ_Kcal, food_table.Protein, food_table.Carbohydr, daily_entries.day 
		FROM food_table, daily_entries 
		WHERE food_table.NDB_No = daily_entries.food_id 
		AND daily_entries.user_id = ".$userId."
		ORDER BY daily_entries.day";
				
		// prepare and bind
		if($stmt = $this->conn->prepare($query)) {
			/* execute statement */
			$stmt->execute();
			/* Store the result (to get properties) */
                        $stmt->store_result();
			/* bind variables to prepared statement */
			$stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6);
			
			/* fetch values */
			$check_result = $stmt->num_rows;
			if ($check_result > 0) {
			echo "<table class='list'>";
			echo "<tr><th>Item</th><th>Amount</th><th>Kcal</th><th>Protein</th><th>Carbs</th></tr>";
			while ($stmt->fetch()) {
				printf ("<tr class='d%s'><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $col6, ucwords(strtolower($col1)), $col2, $col3, $col4, $col5);
			}
			echo "</table>";
			} else {
				echo "<br/><br/><p>This person has not filled out the form yet</p>";
			}
			$stmt->close();

		}
	}
	function get_Username($userId) {
				
		$query = "SELECT firstname, lastname
				FROM users
				WHERE id = ".$userId;
				
		if($stmt = $this->conn->prepare($query)) {
			/* execute statement */
			$stmt->execute();
			
			/* bind variables to prepared statement */
			$stmt->bind_result($col1, $col2);
			
			/* fetch values */
			while ($stmt->fetch()) {
				printf ("%s %s", $col1, $col2);
			}
			$stmt->close();
	
		}
	}
	
}