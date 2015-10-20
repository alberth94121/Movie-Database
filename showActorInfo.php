<html>
<body>

<?php
require($DOCUMENT_ROOT . "./index.html");
?>
<title>CS143 Project 1C</title>

<?php
   $db_connection = mysql_connect("localhost", "cs143", "");
   mysql_select_db("CS143", $db_connection);
   if(!$db_connection)
   {
       $errmsg = mysql_error($db_connection);
       print "Connection failed: $errmsg <br />";
       exit(1);
   }

   $actorList = @mysql_query("SELECT * FROM Actor ORDER BY first");
?>

<b>--- Select Actor --- </b><br>
<hr/>
<form action="./actor.php" method="GET">
        Actor:
	    <select name="actor">
	    <?php
			while($row = @mysql_fetch_assoc($actorList)) 
			{
				print "<option value='" . $row['id'] . "'>" . $row['first'] . " " . $row['last'] . "</option>";
			}
	    ?>
	    </select>
	    <input type="submit" value="Select"/>
</form>
<hr/>

</body>
</html> 