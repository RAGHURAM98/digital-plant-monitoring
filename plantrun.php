// this code runs the plantrun python code in webpage without showing the outputs
<?php
	echo " <br >sensor values are getting from rpi <br>";
	system("python ./plantrun.py");
	echo"<br>sensor values are stored in table sensor<br>";
?>
