<html>
<body>

<?php


$email  = $_REQUEST['username'] ;	
$password = $_REQUEST['password'] ;

$dbconn = mysql_connect("mysql.eecs.ku.edu","smar", "SunShine24-7") or
die('Could not connect: ' . mysql_error());

mysql_select_db('smar') or die('Could not select database');

$query = "SELECT * FROM pb_users WHERE email = '".$email."' AND password = '".$password."'";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());


if(mysql_num_rows($result))
{/*
  echo "<p><b>Profile Page </b></p> \n";
  echo "<table>\n";
  echo "\t<tr>\n";
  echo "\t\t<th>Email</th>\n";
  echo "\t\t<th>Affiliation</th>\n";
  echo "\t\t<th>Password</th>\n";
  echo "\t</tr>\n";
  while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
   echo "\t<tr>\n";
   foreach ($line as $col_value) {
       echo "\t\t<td>$col_value</td>\n";
   }
   echo "\t</tr>\n";
  }
  echo "</table>\n";*/
	// Forward users to next page to generate profile		
	header ("location: profile_page.html");	
}else{
  echo "<p><b>Invalid User Information </b></p> \n";	
}
mysql_free_result($result);
mysql_close($dbconn);
?>

</body>
</html>

