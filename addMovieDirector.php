<html>
<body>

<?php
require($DOCUMENT_ROOT . "./index.html");
?>
<title>CS143 Project 1C</title>

<?php

  $directorID = $_GET["director"];
  $movieID = $_GET["movie"];
	
   $db_connection = mysql_connect("localhost", "cs143", "");
   mysql_select_db("CS143", $db_connection);
   if(!$db_connection)
   {
       $errmsg = mysql_error($db_connection);
       print "Connection failed: $errmsg <br />";
       exit(1);
   }

   $movieInfo = @mysql_query("SELECT title,year,id FROM Movie ORDER BY title");
   $directorInfo = @mysql_query("SELECT first,last, dob,id FROM Director ORDER BY first");
   @mysql_query("INSERT INTO MovieDirector VALUES ($movieID,$directorID)");
?>
  
<b>--- Add Director to Movie --- </b><br>
<hr/>
<form action="./addMovieDirector.php" method="GET"> 
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
    Director:
	<select name="director">
	<?php
			while($row = mysql_fetch_assoc($directorInfo)) 
			{
					$first = $row['first'];
					$last = $row['last'];
					$dob = $row['dob'];
					$did = $row['id'];
					print "<option value='".$did."'>$first $last ($dob)</option>";
			}
	?>
	</select><br/>
    <input type="submit" value="Add!"/>
</form>
<hr/>
			
</body>
</html> 