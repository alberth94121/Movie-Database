<html>
<body>

<?php
require($DOCUMENT_ROOT . "./index.html");
?>
<title>CS143 Project 1C</title>

<?php

   $role = $_GET["role"];
   $actorID = $_GET["actor"];
   $movieID = $_GET["movie"];

   $db_connection = mysql_connect("localhost", "cs143", "");
   mysql_select_db("CS143", $db_connection);
   if(!$db_connection)
   {
       $errmsg = mysql_error($db_connection);
       print "Connection failed: $errmsg <br />";
       exit(1);
   }
   
   $role=  mysql_real_escape_string($role);
   $movieInfo = @mysql_query("SELECT title,year,id FROM Movie ORDER BY title");
   $actorInfo = @mysql_query("SELECT first,last,dob,id FROM Actor ORDER BY first");
   @mysql_query("INSERT INTO MovieActor VALUES ($movieID,$actorID,'$role')");
?>

<b>--- Add Actor to Movie ---</b><br>
<hr/>
<form action="./addMovieActor.php" method="GET"> 
    Movie:
    <select name="movie">
	<?php
			while($row = mysql_fetch_assoc($movieInfo)) 
			{
					$mid = $row['id'];
					$title = $row['title'];
					$year = $row['year'];
					print "<option value='".$mid."'>$title ($year)</option>";
			}
	?>
	</select><br/>
    Actor:
	<select name="actor">
	<?php
			while($row = mysql_fetch_assoc($actorInfo))
			{
					$first = $row['first'];
					$last = $row['last'];
					$dob = $row['dob'];
					$aid = $row['id'];
					print "<option value='".$aid."'>$first $last ($dob)</option>";
			}
	?>
	</select><br/>
	Role:
	<input type="text" name="role" maxlength="50" width="100"><br/>
	<input type="submit" value="Add!"/>
</form>
<hr/>
			
</body>
</html> 