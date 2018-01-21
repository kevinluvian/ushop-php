<?php
class DBController {
	private $host = "cig4l2op6r0fxymw.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
	private $user = "ni2t695dqr8k9ram";
	private $password = "xrtqmz95prk7ge4p";
	private $database = "rsqxw3chrlumstq0";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>

<?php
@$db = new mysqli('cig4l2op6r0fxymw.cbetxkdyhwsb.us-east-1.rds.amazonaws.com','ni2t695dqr8k9ram','xrtqmz95prk7ge4p','rsqxw3chrlumstq0');
// @ to ignore error message display //
if ($db->connect_error){
	echo "Database is not online"; 
	exit;
	// above 2 statments same as die() //
	}
/*	else
	echo "Congratulations...  MySql is working..";
*/
if (!$db->select_db ("rsqxw3chrlumstq0"))
	exit("<p>Unable to locate the rsqxw3chrlumstq0 database</p>");
?>	