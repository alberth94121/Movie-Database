<html>
<body>

<?php
require($DOCUMENT_ROOT . "./index.html");
?>
<title>CS143 Project 1C</title>

<?php
	$type = $_GET["type"];
	$first = $_GET["first"];
	$last = $_GET["last"];
	$sex = $_GET["sex"];
	$dob = $_GET["dob"];
	$dod = $_GET["dod"];

	$db_connection = mysql_connect("localhost", "cs143", "");
    mysql_select_db("CS143", $db_connection);
    if(!$db_connection)
    {
       $errmsg = mysql_error($db_connection);
       print "Connection failed: $errmsg <br />";
       exit(1);
    }

	$type = mysql_real_escape_string($type);
	$first = mysql_real_escape_string($first);
	$last = mysql_real_escape_string($last);
	$sex = mysql_real_escape_string($sex);
	$dob = mysql_real_escape_string($dob);
	$dod = mysql_real_escape_string($dod);

	if($type == "Actor") 
	{
		$maxID = @mysql_query("SELECT id FROM MaxPersonID");
		$row = @mysql_fetch_assoc($maxID);
		$id = $row['id'];
		$id = $id + 1;
		@mysql_query("INSERT INTO Actor VALUES($id, '$last', '$first', '$sex', '$dob', '$dod')");
		@mysql_query("UPDATE MaxPersonID SET id=$id");
	} 
	else if($type == "Director") 
	{
		$maxID = @mysql_query("SELECT id from MaxPersonID");
		$row = @mysql_fetch_assoc($maxID);
		$id = $row['id'];
		$id = $id + 1;
		@mysql_query("INSERT INTO Director VALUES($id, '$last', '$first', '$dob', '$dod')");
		@mysql_query("UPDATE MaxPersonID SET id=$id");
	} 
?>

<b>--- Add Actor/Director --- </b><br>
<hr/>
<form action="./addActorDirector.php" method="GET">
			Type:
			<input type="radio" name="type" value="Actor" checked="true">Actor
			<input type="radio" name="type" value="Director">Director<br/>
			First Name:
			<input type="text" name="first" maxlength="20"><br/>
			Last Name:
			<input type="text" name="last" maxlength="20"><br/>
			Sex:
			<input type="radio" name="sex" value="Male" checked="true">Male
			<input type="radio" name="sex" value="Female">Female<br/>
			Date of Birth:
			<input type="text" name="dob"><br/>
			Date of Death:
			<input type="text" name="dod">(leave blank if alive now)<br/>
			<input type="submit" value="Add!"/>
</form>
<hr/>

</body>
</html>
