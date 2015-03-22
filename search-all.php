<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Search Kevin Bacon</title>
		<!-- php file for searching for movies where the entered actor and Kevin Bacon appear together
        	@author: Zachary Stevens
        -->

		<!-- Links to provided files.  Do not edit or remove these links -->
		<link href="https://webster.cs.washington.edu/images/kevinbacon/favicon.png" type="image/png" rel="shortcut icon" />
		<script src="https://webster.cs.washington.edu/js/kevinbacon/provided.js" type="text/javascript"></script>

		<!-- Link to your CSS file that you should edit -->
		<link href="bacon.css" type="text/css" rel="stylesheet" />
</head>

<body>

	<div id="frame">
    	<!-- header -->
		<div id="banner">
			<a href="index.php"><img src="https://webster.cs.washington.edu/images/kevinbacon/mymdb.png" alt="banner logo" /></a>
			My Movie Database
		</div>

		<div id="main">
            <h1>Results for <?php echo $_GET['firstname'] . " " . $_GET['lastname'] ?></h1> <br/><br/>
            
            Films with <?php echo $_GET['firstname'] . " " . $_GET['lastname'] ?> and Kevin Bacon<br/>
            <table>
           		<tr>
                	<td>#</td>
                    <td>Title</td>
                    <td>Year</td>
                </tr>
            	<?php
					$user = 'root';
					$pass = '';
					$dbh = new PDO('mysql:host=localhost;dbname=imdb', $user, $pass);
					
					//Gets the searched actor's id
					$q1 = "SELECT id FROM actors WHERE first_name = '".$_GET['firstname']."' AND last_name = '".$_GET['lastname']."'";

                    foreach($dbh->query($q1) as $row){
						$id = $row['id']	;
					}

					echo $id;
					
				    /*
                	Joins actors, movies, and roles tables, then Selects movie name and year
                	of the movie the actor appears in.
                	*/
                	`
            		$sql2 = "SELECT m.name, m.year ";
                	$sql2.= "FROM movies m ";
                	$sql2.= "JOIN roles r ON r.movie_id = m.id ";
                	$sql2.= "JOIN actors a ON r.actor_id = a.id ";
                	$sql2.= "WHERE (r.actor_id='".$id."') ";
                	$sql2.= "ORDER BY m.year DESC, m.name ASC";

                	$i = 0;
                	foreach($dbh->query($sql2) as $row){
                		echo "<tr><td>";
                		echo $i+1;
                	    echo "</td><td>";
                		echo $row['name'];
                		echo "</td><td>";
                		echo $row['year'];
                		echo "</td></tr>";
                		$i++;
                	}
                	$dbh = null;
                ?>

                </table>

                <!-- form to search for every movie by a given actor -->
                <form action="search-all.php" method="get">
                	<fieldset>
                    	<legend>All movies</legend>
                			<div>
                	    		<input name="firstname" type="text" size="12" placeholder="first name" autofocus />
                				<input name="lastname" type="text" size="12" placeholder="last name" />
                				<input type="submit" value="go" />
                			</div>
                	</fieldset>
                </form>

                <!-- form to search for movies where a given actor was with Kevin Bacon -->
                <form action="search-kevin.php" method="get">
                	<fieldset>
                		<legend>Movies with Kevin Bacon</legend>
                			<div>
                    			<input name="firstname" type="text" size="12" placeholder="first name" />
                				<input name="lastname" type="text" size="12" placeholder="last name" />
                				<input type="submit" value="go" />
                			</div>
                	</fieldset>
                </form>
            </div>
      </div>
    </body>
</html>