<html>

<body>
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

//Get variables from user registration form
$email = $_REQUEST['email'] ;
$affiliation = $_REQUEST['affiliation'] ;
$pw = $_REQUEST['password'] ;
if ($email && $affiliation && $pw){
	insertSQL($email, $affiliation, $pw);
}else{
	echo "ERROR. Please fill in all of the appropriate information.";
	echo "<FORM METHOD=\"LINK\" ACTION=\"welcome.html\">
<INPUT TYPE=\"submit\" VALUE=\"Back\">
</FORM>";
}

function insertSQL($email, $affiliation, $pw){
	// Connecting, selecting database
	$link = mysql_connect('mysql.eecs.ku.edu', 'smar', 'SunShine24-7')
		or die('Could not connect: ' . mysql_error());
	echo 'Connected successfully';
	mysql_select_db('smar') or die('Could not select database');

	// Check to see if table has already been created
	$checktable = mysql_query("SHOW TABLES LIKE 'pb_users'");
	$table_exists = mysql_num_rows($checktable) > 0;
	if($table_exists == 0){
		$query = "CREATE TABLE pb_users (
			email varchar(100) primary key, 
			affiliation varchar(100), 
			password varchar(15))"; 
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		echo "Table pb_users was created";
	}

	// Insert new user information into pb_users table.
	$query = "INSERT INTO pb_users VALUES ('" . $email . "', '" . $affiliation . "', '" . $pw . "');";  
	$result = mysql_query($query);
	if(!($result)){
		die('Query failed: ' . mysql_error());
	}else{
		// Free resultset
		//mysql_free_result($result);

		// Closing connection
		mysql_close($link);
		
		// Forward users to next page to generate profile		
		header ("location: users/profile_page.html");
		
	}

}
?>
</body>
</html>
