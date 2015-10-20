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
   
   $movieList = @mysql_query("SELECT title,year,id FROM Movie ORDER BY title");
?>

<b>--- Select Movie --- </b><br>
<hr/>
<form action="./movie.php" method="GET">
		Movie:
		<select name="movie">
		<?php
			while($row = @mysql_fetch_assoc($movieList)) 
			{
				print "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
			}
		?>
		</select>
		<input type="submit" value="Select"/>
</form>
<hr/>
			
</body>
</html> 