<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<title>Bus Plan - Search Result</title>

	<link rel="icon" href="images/titleicon.png">
	<link href="style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Sofia&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <style>
    @import url("https://fonts.googleapis.com/css?family=Lato&display=swap");
    </style>

    <style type="text/css">

    /* Top */ 
    table {
        width: 90vw;
        border: 1px solid gray;
    }

    th, td {
        text-align: left;
        padding: 16px;
    }

    .bus_route_header table {
        border: 1px solid gray;
        border-collapse: collapse;
    }

    .bus_route_header th {
        border: 1px solid gray;
        border-collapse: collapse;
       
    }

    .bus_route_header td {
        border: 1px solid gray;
        border-collapse: collapse;
        
    }

    .buslogo {
        width: 200px;
        height: 110px;
    }


    /* Bottom */
    .bus_route_title_content table {
        border: 0px;
    }

    .bus_route_content table {
        border: 1px solid gray;
    }

    .bus_route_title_content td, .bus_route_content td {
        width: 20%;
    }

    @media(max-width:320px){
        .container{
            max-width:320px;
        }
    }

    </style>
</head>
<body>
    <div class="row">
        <div class="col-sm-12 col-lg-6">
    <!-- Database -->
    <?php
   include "sidebar.php";
    echo '<a href="index.php"><img src="images/tombuslogo2.png" width="150px" height="150px;"></a>';
        $departure = $_GET['departure'];
        $destination = $_GET['destination'];
        $onwardDate = $_GET['onwardDate'];
        $returnDate = $_GET['returnDate'];

        //$dbc = mysqli_connect('localhost','root','');

        //mysqli_select_db($dbc,'busplan');
        
        //mysqli_close($dbc);
    
        if (isset($departure) && isset($destination) && isset($onwardDate)) {

            echo"<h4 style=\"padding-left:85px;\">Bus From $departure to $destination</h4>";

            echo'<div class="bus_route_header">';
                echo"<table style=\"margin-left: 5vw;\">";
                    echo"<tr>";
                        echo"<th>ONWARD JOURNEY</th>";
                    echo"</tr>";

                    echo"<tr>";
                        echo"<td>$departure &#8594 $destination &nbsp; &nbsp; $onwardDate</td>";
                    echo"</tr>";
                echo"</table>";
            echo"</div>";
        }
    ?>

    <!-- Result -->
    <br/><br/>
    <div class="bus_route_content">
        <table style="margin-left: 5vw; border: none">
                <tr>
                    <td> </td>
                    <td>Departure</td>
                    <td>Duration</td>
                    <td>Arrival</td>
                    <td>Fare</td>
                </tr>
        </table>
    </div>

    <?php		
		//connect database
		$dbc = mysqli_connect('localhost', 'root', '');

		if (!$dbc) {
			die("Error: " . mysqli_connect_error($dbc));
		}

		mysqli_select_db($dbc, 'busplan');

		$query = "SELECT * FROM busroute r, bus b 
                WHERE departure='$departure'
                AND destination='$destination'
                AND date='$onwardDate'
                AND b.bus_id = r.bus_id";
        
        if ($r = mysqli_query($dbc, $query)) {

            //if no record found
            if (mysqli_num_rows($r) == 0) {
                echo "Bus Route not found.";
            }

            else {

                while ($row = mysqli_fetch_array($r)) {  

                    $diff = strtotime($row['arrival_time']) - strtotime($row['departure_time']);        
                    $duration = gmdate('h', $diff) . " hrs " . gmdate('i', $diff) . " mins ";

                    echo "
                        <div class=\"col-sm-12 col-lg-6\">
                        <div class=\"bus_route_content\">
                            <table style=\"margin-left: 5vw;\">
                                    <tr>
                                        <td><img src=\"images/{$row['bus_logo']}\" class=\"buslogo\"></td>
                                        <td><b>{$row['departure_time']}</b></td>
                                        <td><font color=\"gray\">$duration</font></td>
                                        <td><b>{$row['arrival_time']}</b></td>
                                        <td>MYR <b>{$row['fare']}</b></td>
                                    </tr>

                                    <tr>
                                        <td>{$row['bus_name']}</td>
                                        <td>{$row['departure']}</td>
                                        <td></td>
                                        <td>{$row['destination']}</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href=\"busdetails.php\" target=\"_blank\">Bus Details</a></td>
                                        <td>
                                            <a href=\"view_seat.php?route_id={$row['route_id']}\">
                                                <button name=\"bus_id\" class=\"btn\">
                                                    VIEW SEATS
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                            </table>

                        </div>
                        </div>"; 
                }
            }
        }

		else  {
			echo '<p style=\"color:red;\">Could not retrieve the data because: <br/>' . mysqli_error($dbc) . '</p><p>The query being run was: ' . $query . '</p>';
		}
		mysqli_close($dbc);
        echo "<br/><br/><br/><br/><br/><br/><br/>";
    ?>
    </div>
    </div>
</body>
</html>
