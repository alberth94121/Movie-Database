<html>
<body>

<?php
require($DOCUMENT_ROOT . "./index.html");
?>
<title>CS143 Project 1C</title>

<?php
   $aid = $_GET["actor"];
	
   $db_connection = mysql_connect("localhost", "cs143", "");
   mysql_select_db("CS143", $db_connection);
   if(!$db_connection)
   {
       $errmsg = mysql_error($db_connection);
       print "Connection failed: $errmsg <br />";
       exit(1);
   }
   
   $actorInfo = @mysql_query("SELECT * FROM Actor WHERE id = $aid");
   $roles = @mysql_query("SELECT role,title,id FROM Movie, MovieActor WHERE aid=$aid AND mid=id");
?>

<b>--- Actor Information --- </b><br>
<?php
    $row = @mysql_fetch_assoc($actorInfo);
	print   "Name: " . $row['first'] . " " . $row['last'] . "<br>".
		    "Sex: " . $row['sex'] . "<br>" .
			"Date of Birth: " . $row['dob'] . "<br>".
			"Date of Death: " . $row['dod'] . "<br>";
  
  
    print "<br><b>--- Acted in --- </b><br>";
    while ($row2 = @mysql_fetch_row($roles))
    {  
				$form_name = "movieForm" .$row2[2]; 
				print "<form name='$form_name' method='GET' action='./movie.php'>" .
				      "<a href='#' onclick='document.$form_name.submit();return false;'>" .$row2[1] . "</a>" .
				      "<input type='hidden' name='movie' value='".$row2[2]."'/>" .
                      " as " . $row2[0] . 
				      "</form>";
    }
?>

</body>
</html>
