//this code can buffer the webpage annd can display the outputs for every 30 seconds

<?php
echo "<br> ||date and time|| ||humidity|| || temperature|| ||LDR|| || soil moisture|| <br>";
while(1){
		ob_start();
		system("python ./sql.py");
		system("python ./sensordatabase.py");
		sleep(2);
		$servername = "localhost";
		$username = "root";
		$password = "1234";
		$dbName = "digitalplant";
		$conn = new mysqli($servername, $username, $password, $dbName);
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
	$query="SELECT `datetime`, `temperature`, `humidity`, `ldr`, `soilmoisture` FROM `outsql` WHERE 1";
	//	$query="SELECT `datetime`, `temperature`, `humidity`, `ldr` FROM `outsql` WHERE 1";
	//$query="select 'datetime' BETWEEN 'DATE_SUB(N0W(), INTERVAL 1 minute)' AND 'NOW()'";
	//$query="SELECT * FROM `outsql`";
	//$query="SELECT * FROM `outsql` WHERE `datetime` >= 'NOW()'";
	//$query="SELECT `datetime`, `temperature`, `humidity`, FROM `outsql` WHERE 1";
	//$query = "SELECT * FROM `outputlog` ";
	//$query = "SELECT * FROM `outsql` WHERE `datetime` = 'now'";
	//storing the result of the executed query
		$result = $conn->query($query);		
		
			echo "hello";
		//check if there is any data returned by the SQL Query
		if (($result->num_rows > 0)) {
			echo "hello";
		//echo "<br> ||date and time|| ||humidity|| || temperature|| ||LDR|| <br>";
		  //Converting the results into an associative array
		 while($row = $result->fetch_assoc()) {  	
			 
		echo " <br> ||".$row["datetime"],"|| ||".$row["humidity"],"|| ||".$row["temperature"]. "|| ||".$row["ldr"],"|| ||".$row["soilmoisture"],"|| <br>";	
		//ob_flush();
		//ob_end_flush();
		}
		}

	system("python ./truncate.py");
	$conn->close();
	//flush();
	ob_flush();
	ob_end_flush();
}
	?>

