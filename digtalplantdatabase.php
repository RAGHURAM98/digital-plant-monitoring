// this code displays the total database stored in sensor table.
<?php
		$servername = "localhost";
		$username = "root";
		$password = "1234";
		$dbName = "digitalplant";
		$conn = new mysqli($servername, $username, $password, $dbName);
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);}
	$query="SELECT `datetime`, `temperature`, `humidity`, `ldr`, `soilmoisture` FROM `sensor` WHERE 1";	
	//$query="SELECT * FROM `outsql` WHERE `datetime` = 'NOW()'";
	//$query="SELECT `datetime`, `temperature`, `humidity` FROM `sensor` WHERE 1";
	//$query = "SELECT * FROM `outputlog` ";
	//$query = "SELECT * FROM `outsql` WHERE `datetime` = 'now'";
	//storing the result of the executed query
		$result = $conn->query($query);
		//check if there is any data returned by the SQL Query
		if ($result->num_rows > 0) {
		echo "<br> ||date and time|| ||humidity|| || temperature|| ||ldr|| ||soil moisture||<br>";
		  //Converting the results into an associative array
		 
		 while($row = $result->fetch_assoc()) {  
		 echo " <br> ||".$row['datetime'],"|| ||".$row['humidity'],"|| ||".$row['temperature'], "|| ||".$row['ldr'],"|| ||".$row['soilmoisture'],"||";
		   "<br>";
		}
		}
		else{
	echo"0 results";
	}
		$conn->close();
	?>
