<?php
$cmd = $_GET["cmd"];
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Cloud Foundry demo</title>
  <meta name="description" content="Cloud Foundry demo">
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  
  <div id="img">
      <img src="http://cloudfoundry.org/images/logo_org.png"/>
  </div>


	<div id="content-container">
		<div id="content2">
		<h2>MySQL Service</h2>
		<hr />
		<?php
		$services = getenv("VCAP_SERVICES");
		$services_json = json_decode($services, true);
		$mysql_config = $services_json["mysql-5.5"][0]["credentials"];
		$db = $mysql_config["name"];
		$host = $mysql_config["host"];
		$port = $mysql_config["port"];
		$username = $mysql_config["user"];
		$password = $mysql_config["password"];
		if ($host == "") {
			echo "<b> There is no mysql service.</b><br>";
		} else {
		?>
		MySQL DB Name : <?php echo $db ?> <br>
		MySQL Host : <?php echo $host ?> <br>
		MySQL Port : <?php echo $port ?> <br>
		MySQL username : <?php echo $username ?> <br>
		MySQL password : <?php echo "********" ?><br>
		<hr>
		<b> Create Table</b><br>
		<?php
		$conn = mysql_connect($host . ':' . $port, $username, $password);
		if(! $conn ) {
			echo('Could not connect: ' . mysql_error());
		}
		mysql_select_db($db);
		 if ($cmd == "create") {
			$sql_create = 'CREATE TABLE SAMPLE (name CHAR(30), comment CHAR(255), time DATETIME)';
			$retval = mysql_query($sql_create, $conn);
			if(! $retval ) {
			  echo('Could not create database table: ' . mysql_error() . '<br/>');
			} else {
		  	  echo "<script>alert('Created database table successfully')</script><script>window.location='mysql-info.php'</script>";
		    }
		 } ?>
		<a href="mysql-info.php?cmd=create">[Create] </a>
		<hr>
		<b> Insert Data</b><br>
		<?php
		$sql_read = 'SELECT * FROM SAMPLE ';
		$retval = mysql_query($sql_read, $conn);
		if(! $retval ) {
		  echo('Could not read SAMPLE table: ' . mysql_error());
		}
		echo "<table><tr><td>name</td><td>comment</td><td>Date</td>";
		while ($dbfield = mysql_fetch_assoc($retval)) {
		    echo "<tr><td>".$dbfield['name'] . '</td>';
		    echo "<td>".$dbfield['comment'] . '</td/>';
		    echo "<td>".$dbfield['time'] . '</td></tr>';
		}
		echo "</table>";
		?>

		<?php
		if ($cmd == "insert") {
			$sql_insert = 'INSERT INTO SAMPLE (name, comment, time) VALUES ( "name",   "comment", NOW() )';
			$retval = mysql_query($sql_insert, $conn );
			if(! $retval ) {
			  echo('Could not enter data: ' . mysql_error() . '<br/>');
			} else {
		  	  echo "Entered data successfully<br/><script>window.location='mysql-info.php'</script>";
		    }
		 } ?>
		<a href="mysql-info.php?cmd=insert">[Insert] </a>
		<hr>
		<b> Drop Table</b><br>
		<?php
		 if ($cmd == "drop") { 	
			$sql_drop = 'DROP TABLE SAMPLE';
			$retval = mysql_query($sql_drop, $conn);
			if(! $retval ) {
			  echo('Could not drop database table: ' . mysql_error() . '<br/>');
			} else {
		  	  echo "<script>alert('Dropped database table successfully')</script><script>window.location='mysql-info.php'</script>";
		    }
		 } ?>
		<a href="mysql-info.php?cmd=drop">[Drop] </a>
		<?php }?>
		</div>

		</div>
		</div>
		</div>

	</div>
</body>
</html>
