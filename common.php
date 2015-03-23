<?php

	//@author Joseph Pallansch
	//Common data shared across both search files.  Mainly, DB connection info, and the query to get the actor id

    $user = 'root'; //Enter your mySQL server username
    $pass = '';  //enter your mySQL server password
    $dbh = new PDO('mysql:host=localhost;dbname=imdb', $user, $pass);

//Gets the searched actor's id, tiebreaker is filmCount
$q1 = "SELECT id 
		FROM actors 
		WHERE (first_name LIKE '".$_GET['firstname']." %' OR first_name = '".$_GET['firstname']."') AND last_name = '".$_GET['lastname']."' 
		AND film_count >= all(SELECT film_count 
								FROM actors 
								WHERE (first_name LIKE'".$_GET['firstname']." %' OR first_name = '".$_GET['firstname']."') 
								AND last_name = '".$_GET['lastname']."')";
$id = null;
//only returns 1 row
foreach($dbh->query($q1) as $row){
    $id = $row['id']	;
}
//If actor is not in the database
if($id == null){
    echo "Actor ";
    echo $_GET['firstname'];
    echo " ";
    echo $_GET['lastname'];
    echo " not found.";
}
?>
