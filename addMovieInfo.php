<html>
<body>

<?php
require($DOCUMENT_ROOT . "./index.html");
?>
<title>CS143 Project 1C</title>

<?php
   $title = $_GET["title"];
   $company = $_GET["company"];
   $year = $_GET["year"];
   $rating = $_GET["rating"];
   $genre_Action = $_GET["genre_Action"];
   $genre_Adult = $_GET["genre_Adult"];
   $genre_Adventure = $_GET["genre_Adventure"];
   $genre_Animation= $_GET["genre_Animation"];
   $genre_Comedy = $_GET["genre_Comedy"];
   $genre_Crime = $_GET["genre_Crime"];
   $genre_Documentary = $_GET["genre_Documentary"];
   $genre_Drama = $_GET["genre_Drama"];
   $genre_Family = $_GET["genre_Family"];
   $genre_Fantasy = $_GET["genre_Fantasy"];
   $genre_Horror = $_GET["genre_Horror"];	
   $genre_Musical = $_GET["genre_Musical"];
   $genre_Mystery = $_GET["genre_Mystery"];
   $genre_Romance = $_GET["genre_Romance"];
   $genre_Scifi = $_GET["genre_Sci-Fi"];
   $genre_Short = $_GET["genre_Short"];
   $genre_Thriller = $_GET["genre_Thriller"];
   $genre_War = $_GET["genre_War"];
   $genre_Western = $_GET["genre_Western"];	

   $db_connection = mysql_connect("localhost", "cs143", "");
   mysql_select_db("CS143", $db_connection);
   if(!$db_connection)
   {
       $errmsg = mysql_error($db_connection);
       print "Connection failed: $errmsg <br />";
       exit(1);
   }

   $title = mysql_real_escape_string($title);
   $company = mysql_real_escape_string($company);
   $year = mysql_real_escape_string($year);
   $rating = mysql_real_escape_string($rating);
    
   $maxID = @mysql_query("SELECT id FROM MaxMovieID");
   $row = @mysql_fetch_assoc($maxID);
   $id = $row['id'];
   $id = $id + 1;
   @mysql_query("INSERT INTO Movie VALUES($id, '$title', $year, '$rating', '$company')");
   @mysql_query("UPDATE MaxMovieID SET id=$id");
   $ratingList = @mysql_query("SELECT DISTINCT rating FROM Movie ORDER BY rating");
   if($genre_Action)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Action')");
   }
   if($genre_Adult)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Adult')");
   }
   if($genre_Adventure)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Adventure')");
   }
   if($genre_Animation)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Animation')");
   }
   if($genre_Comedy)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Comedy')");
   }
   if($genre_Crime)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Crime')");
   }
   if($genre_Documentary)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Documentary')");
   }
   if($genre_Drama)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Drama')");
   }
   if($genre_Family)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Family')");
   }
   if($genre_Fantasy)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Fantasy')");
   }
   if($genre_Horror)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Horror')");
   }
   if($genre_Musical)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Musical')");
   }
   if($genre_Mystery)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Mystery')");
   }
   if($genre_Romance)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Romance')");
   }
   if($genre_Scifi)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Scifi')");
   }
   if($genre_Short)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Short')");
   }
   if($genre_Thriller)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Thriller')");
   }
   if($genre_War)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_War')");
   }
   if($genre_Western)
   {
	    @mysql_query("INSERT INTO MovieGenre VALUES($id, '$genre_Western')");
   }
?>

<b>---- Add Movie --- </b><br>
<hr/>
 <form action="./addMovieInfo.php" method="GET">
			Title:
			<input type="text" name="title" maxlength="100" size="50"><br/>
			Company:
			<input type="text" name="company" maxlength="50" size="50"><br/>
			Year:
			<input type="text" name="year" maxlength="4" size="4"><br/>
			MPAA Rating:
			<select name="rating">
			<?php
				while($row = mysql_fetch_assoc($ratingList)) 
				{
					$rating = $row['rating'];
					print "<option value='".$rating."'>$rating</option>";
				}
			?>
			</select><br/>
			Genre : 
			<input type="checkbox" name="genre_Action" value="Action">Action</input>
            <input type="checkbox" name="genre_Adult" value="Adult">Adult</input>
            <input type="checkbox" name="genre_Adventure" value="Adventure">Adventure</input>
            <input type="checkbox" name="genre_Animation" value="Animation">Animation</input>
            <input type="checkbox" name="genre_Comedy" value="Comedy">Comedy</input>
            <input type="checkbox" name="genre_Crime" value="Crime">Crime</input>
            <input type="checkbox" name="genre_Documentary" value="Documentary">Documentary</input>
            <input type="checkbox" name="genre_Drama" value="Drama">Drama</input>
            <input type="checkbox" name="genre_Family" value="Family">Family</input>
            <input type="checkbox" name="genre_Fantasy" value="Fantasy">Fantasy</input>
            <input type="checkbox" name="genre_Horror" value="Horror">Horror</input>
            <input type="checkbox" name="genre_Musical" value="Musical">Musical</input>
            <input type="checkbox" name="genre_Mystery" value="Mystery">Mystery</input>
            <input type="checkbox" name="genre_Romance" value="Romance">Romance</input>
            <input type="checkbox" name="genre_Sci-Fi" value="Sci-Fi">Sci-Fi</input>
            <input type="checkbox" name="genre_Short" value="Short">Short</input>
            <input type="checkbox" name="genre_Thriller" value="Thriller">Thriller</input>
            <input type="checkbox" name="genre_War" value="War">War</input> <br>
            <input type="checkbox" name="genre_Western" value="Western">Western</input><br/>
            <input type="submit" value="Add!"/>
</form>
<hr/>

</body>
</html>  
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   