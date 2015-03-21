<?php
    $link = mysql_connect('localhost', 'root', 'kaiden90');
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    //specify the database
    $db = mysql_select_db('imdb', $link);
    //Gets the searched actor's id
    $sql = "SELECT id
            FROM actors
            WHERE first_name LIKE'".$_GET['firstname']."%' AND last_name = '".$_GET['lastname']."'
            AND film_count <=
                all(SELECT film_count
                    FROM actors
                    WHERE first_name LIKE '".$_GET['firstname']."%' AND last_name = '".$_GET['lastname']."')";
    $result = mysql_query($sql, $link);
    $num=mysql_numrows($result);
    if($num == 0){
        echo "Actor ";
        echo $_GET['firstname'];
        echo " ";
        echo $_GET['lastname'];
        echo " not found.";
    }
    else {
        $id = mysql_result($result, 0, 'id');
    }
    mysql_close($link);
?>
