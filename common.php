<?php
    $user = 'root';
    $pass = '';
    $dbh = new PDO('mysql:host=localhost;dbname=imdb', $user, $pass);

//Gets the searched actor's id
$q1 = "SELECT id
            FROM actors
            WHERE (first_name LIKE '".$_GET['firstname']." %' OR first_name = '".$_GET['firstname'].
                    "') AND last_name = '".$_GET['lastname']."'
                AND film_count >=
                all(SELECT film_count
                    FROM actors
                    WHERE (first_name LIKE'".$_GET['firstname']." %' OR first_name = '".$_GET['firstname'].
                    "') AND last_name = '".$_GET['lastname']."')";
$id = null;
foreach($dbh->query($q1) as $row){
    $id = $row['id']	;
}
if($id == null){
    echo "Actor ";
    echo $_GET['firstname'];
    echo " ";
    echo $_GET['lastname'];
    echo " not found.";
}
$dbh = null;
?>
