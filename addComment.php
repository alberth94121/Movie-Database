<html>
<body>

<?php
require($DOCUMENT_ROOT . "./index.html");
?>
<title>CS143 Project 1C</title>

<?php
    $mid =$_GET["movie"];
	$name = $_GET["name"];
	$comment = $_GET["comment"];
	$rating = $_GET["rating"];

	$db_connection = mysql_connect("localhost", "cs143", "");
    mysql_select_db("CS143", $db_connection);
    if(!$db_connection)
    {
       $errmsg = mysql_error($db_connection);
       print "Connection failed: $errmsg <br />";
       exit(1);
    }

	$movieInfo = @mysql_query("SELECT title from Movie where id=$mid");
    if($rating)
	{
	    $comment = mysql_real_escape_string($comment);
		$name = mysql_real_escape_string($name);
		$rating = mysql_real_escape_string($rating);
        @mysql_query("INSERT INTO Review VALUES('$name', CURRENT_TIMESTAMP(), $mid, $rating, '$comment')");
	}	
?>

<b>--- Add Comment ---</b><br>
<hr/>
<form action="./addComment.php" method="GET">
			Movie:
			<?php
				print "<input type='hidden' name='movie' value='$mid'/>";
				$row = @mysql_fetch_assoc($movieInfo);
				print $row['title'] ."<br>";
			?>
            Your Name:
			<input type="text" name="name" maxlength="100" width="100"><br/>
   		    Comment:<br>
			<textarea name="comment" cols="40" rows="5"></textarea><br/>
			Rating:
			<select name="rating">
			<option value="5">5-Excellent</option>
			<option value="4">4-Good</option>
			<option value="3">3-Ok</option>
			<option value="2">2-Bad</option>
			<option value="1">1-Terrible</option>
			</select><br/>
			<input type="submit" value="Comment"/>
</form>
<hr/>

</body>
</html>