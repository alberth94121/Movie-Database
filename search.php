<html>
<body>

<?php
require($DOCUMENT_ROOT . "./index.html");
?>
<title>CS143 Project 1C</title>

<br><b> --- Search Actors and Movies--- </b><br>
<hr/>
<?php
   $search = $_GET["search"];
   
   $db_connection = mysql_connect("localhost", "cs143", "");
   mysql_select_db("CS143", $db_connection);
   if(!$db_connection)
   {
       $errmsg = mysql_error($db_connection);
       print "Connection failed: $errmsg <br />";
       exit(1);
   }
   $search = mysql_real_escape_string($search);

   if($search)
   {
       print " <br><b>--- List of Actors ---</b><br>";
       $array = explode(' ', $search, 2);
       $actorMatch = @mysql_query("SELECT first,last,id,dob FROM Actor WHERE (first LIKE '%$array[0]%' AND last LIKE '%$array[1]%')
                                  OR( first LIKE '%$array[1]%' AND last LIKE '%$array[0]%') ");
       while($row = @mysql_fetch_assoc($actorMatch))
       {           
         $id =$row['id'];
		 $form_name = "actorForm" . $id;
		  print "<form name='$form_name' method='GET' action='./actor.php'>" . 
			    "<input type='hidden' name='actor' value='$id'>" .
			    "<a href='#' onclick='document.$form_name.submit();return false;'>".$row['first'] . " " . $row['last']. " (" . $row['dob'] .")" . "</a>" .
			    "</form>";
       }
   }
   if($search)
   {
       print "<br><b>--- List of Movies ---</b><br>";
       $movieMatch = @mysql_query("SELECT title,id,year FROM Movie WHERE title LIKE '%$search%'");
       while( $row = @mysql_fetch_assoc($movieMatch))
       {           
            $form_name = "movieForm" .$row['id']; 
		    print "<form name='$form_name' method='GET' action='./movie.php'>" .
				  "<a href='#' onclick='document.$form_name.submit();return false;'>" .$row['title'] . " (" . $row['year'] .")". "</a>" .
				  "<input type='hidden' name='movie' value='".$row['id']."'/>" .
                  "</form>";
       }
   }
?>

<br>
<form action="./search.php" method="GET"> 
			<input type="text" name="search" maxlength="100" width="100"><br/>
			<input type="submit" value="Search"/>
</form>
<hr/>
			
</body>
</html>

			
			