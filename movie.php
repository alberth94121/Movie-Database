<html>
<body>

<?php
require($DOCUMENT_ROOT . "./index.html");
?>
<title>CS143 Project 1C</title>

<?php
   $mid = $_GET["movie"];
	
   $db_connection = mysql_connect("localhost", "cs143", "");
   mysql_select_db("CS143", $db_connection);
   if(!$db_connection)
   {
       $errmsg = mysql_error($db_connection);
       print "Connection failed: $errmsg <br />";
       exit(1);
   }
   
   $movieInfo = @mysql_query("SELECT * FROM Movie WHERE id = $mid");
   $directorInfo = @mysql_query("SELECT * FROM Director WHERE id in (SELECT did FROM MovieDirector WHERE mid = $mid)");
   $genreInfo = @mysql_query("SELECT DISTINCT * FROM MovieGenre WHERE mid = $mid");
   $actors = @mysql_query("SELECT * FROM MovieActor WHERE mid = $mid ORDER BY aid");
   $averageRank = @mysql_query("SELECT AVG(rating) AS rating FROM Review WHERE mid = $mid");
   $rank = @mysql_fetch_assoc($averageRank);
   $averageRankValue = $rank['rating'];
   if(!$averageRankValue)
   {
      $averageRankValue = 0;
   }
   $commentsInfo = @mysql_query("SELECT * FROM Review WHERE mid = $mid");
?>

<b> --- Movie Information ---</b><br>
<?php
    $row = @mysql_fetch_assoc($movieInfo);
	print "Title: " . $row['title'] . "<br>" .
	      "Producer: " . $row['company'] . "<br>" .
	      "MPAA Rating: " . $row['rating'] . "<br>" .
	      "Director: "; 
	      while($row2 = @mysql_fetch_assoc($directorInfo)) 
		  {
		       print $row2['first'] . " " . $row2['last'] . " (" . $row2['dob'] . "), ";
		  } 
	print "<br> Genres: ";
	      while($row3 = @mysql_fetch_assoc($genreInfo)) 
		  {
			   print $row3['genre'].", ";
		  }
?>

<br><br><b>--- Actors in this Movie ---</b><br>
<?php
     while($row = @mysql_fetch_assoc($actors)) 
	 {
          $actorID = $row['aid'];
          $actorInfo = @mysql_query("SELECT * FROM Actor WHERE id = $actorID");
          $row2 = @mysql_fetch_assoc($actorInfo);
          $form_name = "actorForm" . $actorID;
		  print "<form name='$form_name' method='GET' action='./actor.php'>". 
			    "<input type='hidden' name='actor' value='$actorID'>" .
			    "<a href='#' onclick='document.$form_name.submit();return false;'>".$row2['first'] . " " . $row2['last'] . "</a>" .
			    " as " . $row['role'] . 
				"</form>";
}
?>

<br><b>--- Average Rating --- </b><br>
<?php 
      print $averageRankValue 
?>
 
<br><br><b>--- Reviews --- </b><br>
<form name="reviewForm" method="GET" action="./addComment.php">
    <?php
         print "<input type='hidden' name='movie' value='$mid'/>";
		 while($row_info = @mysql_fetch_assoc($commentsInfo)) 
		 {
			print "On " . $row_info['time'].", " .
			      "<font color='FF0000'>" . $row_info['name'] . "<font color='000000'>" .
                  " gave this movie a rating of ". $row_info['rating'] . " point(s) and commented:" . "<br>" .
				  $row_info['comment'] . "<br>";
		 }
   ?>
   <input type="submit" value="Add Review!"/>
</form>
	
</body>
</html>





