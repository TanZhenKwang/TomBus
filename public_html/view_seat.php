<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, intial-scale=1.0">
	<title>Tom Bus - View Seat</title>

	<link rel="icon" href="images/titleicon.png">
	<link href="style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Sofia&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</head>

    <style type="text/css">

    /* Top */ 

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    table {
        width: 90vw;
        border: 1px solid lightgray;
        border-radius: 20px;
    }

    th, td {
        text-align: left;
        padding: 16px;
    }

    .buslogo {
        width: 100px;
        height: 100px;
    }

    @media(max-width:350px){
        *{
            max-width:300px;
        }
    }
    </style>

<body>
    <!-- Database -->
        <div class="row">
            <div class="col-sm-12 col-lg-6">
    <?php	
        session_start();
        $route_id = $_GET['route_id'];

		//connect database
		$dbc = mysqli_connect('localhost', 'root', '');

		if (!$dbc) {
			die("Error: " . mysqli_connect_error($dbc));
		}

		mysqli_select_db($dbc, 'busplan');

		$query = "SELECT * FROM busroute r, bus b WHERE route_id = '$route_id' AND b.bus_id = r.bus_id";
        
        if ($r = mysqli_query($dbc, $query)) {

            //if no record found 
            if (mysqli_num_rows($r) == 0) {
                echo "Bus Route not found.";
            }

            else {
                while ($row = mysqli_fetch_array($r)) {  
                
                    $diff = strtotime($row['arrival_time']) - strtotime($row['departure_time']);        
                    $duration = gmdate('h', $diff) . " hrs " . gmdate('i', $diff) . " mins ";
                    $fare = $row['fare'];

                    echo "  <h1>Please choose your seat</h1>
                        <form action=\"payment.php\" method=\"get\">
                            <table>
                                <tr>
                                    <td>
                                    <div class=\"seat_layout\" id=\"seat_layout_id\">
                                        <div class=\"bus_screen\"></div>
                                        <div class=\"steering\">
                                            <img src=\"images/steering.png\" width=\"30\" height=\"30\">
                                        </div>";

                                            $seatno = 1; 
                                            
                                            for ($i=1; $i<=11; $i++) {

                                                echo "<div class=\"container\">";
                                                echo "<div class=\"seats\">";

                                                $bus_id = $row['bus_id'];
                                                $_SESSION['bus_id']= $bus_id;
                                                $counter = 0;
                                                while ($counter<2) {
                                                    $label = $row['route_id'] . $seatno;      
                                                    $query = "SELECT seat_no FROM booking WHERE bus_id='$bus_id' AND seat_no='$seatno'";

                                                    if (mysqli_num_rows(mysqli_query($dbc, $query)) == 0) {
                                                        echo "<div>
                                                              <input id=\"$label\" class=\"seat-select\" type=\"checkbox\" value=\"$seatno\" name=\"seat[]\"
                                                              onclick=\"showSeatNo(this)\" onchange =\"checkboxes()\">
                                                              <label for=\"$label\" class=\"seat\" ><span>$seatno</span></label>
                                                              </div>";
                                                    }
                                                    else {
                                                        echo "<div>
                                                            <input id=\"$label\" class=\"seat-select\" type=\"checkbox\" value=\"$seatno\" name=\"seat[]\" />
                                                            <label for=\"$label\" class=\"seat_sold\"></label>
                                                            </div>";
                                                    }

                                                    $counter++;
                                                    $seatno++;

                                                    
                                                    
                                                }

                                                $counter = 0;
                                                echo "<div style=\"width:40px;height:40px\"></div>";

                                                while ($counter<2) {
                                                    $label = $row['route_id'] . $seatno;
                                                    $query = "SELECT seat_no FROM booking WHERE bus_id='$bus_id' AND seat_no='$seatno'";

                                                    if (mysqli_num_rows(mysqli_query($dbc, $query)) == 0) {
                                                        echo "<div>
                                                              <input id=\"$label\" class=\"seat-select\" type=\"checkbox\" value=\"$seatno\" name=\"seat[]\" onclick=\"showSeatNo(this)\" onchange=\"checkboxes()\">
                                                              <label for=\"$label\" class=\"seat\"><span>$seatno</span></label>
                                                              </div>";
                                                    }
                                                    else {
                                                        echo "<div>
                                                            <input id=\"$label\" class=\"seat-select\" type=\"checkbox\" value=\"$seatno\" name=\"seat[]\" >
                                                            <label for=\"$label\" class=\"seat_sold\"></label>
                                                            </div>";
                                                    }

                                                    $counter++;
                                                    $seatno++;
                                                    
                                                }
                                                echo "</div>";
                                                echo "</div>";
                                            }
                                        echo "

                                        </div>
                                        </td>
                                        
                                        <td>    
                                            <div>
                                            
                                                <div class=\"seat\"></div>
                                                <small>Available</small>
                                           
                                                <div>
                                                    <input id=\"seatselected\" class=\"seat-select\" type=\"checkbox\" value=\"$seatno\" checked=\"checked\">
                                                    <label for=\"seatselected\" class=\"seat\"></label>
                                                </div>
                                                <small>Selected</small>
                                           
                                                <div class=\"seat_sold\"></div>
                                                <small>Sold</small>
                                            </div>     
                                        </td>
            
                                    <td>
                             
                                    <div style=\"float:left;width:400px;border:1px solid gray;border-radius:20px;padding:40px\">

                                        <table style=\"width:400px;border:none;\">
                                            <tr>
                                                <td colspan=\"3\"><h3>Boarding and Dropping</h3></td>
                                            </tr>
                                            
                                            <tr>
                                                <td colspan=\"2\">{$row['departure']}</td> 
                                                <td>{$row['departure_time']}</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class=\"fa fa-arrow-down\"></i></td>
                                            </tr>
                                            <tr>
                                                <td colspan=\"2\">{$row['destination']}</td>
                                                <td>{$row['arrival_time']}</td>
                                            </tr>
                                        
                                            <tr><td colspan=\"3\"><hr></td></tr>

                                            <tr>
                                                <th colspan=\"2\">Seat No.</th>
                                                <td id=\"seat_no_text\"></td>
                                            </tr>

                                            <tr><td colspan=\"3\"><hr></td></tr>

                                            <tr>
                                                <th colspan=\"2\">Amount.</th>
                                                <td>RM &nbsp;<span id=\"totalFare\"></span></td>
                                            </tr>
                                          
                                            <tr><td colspan=\"3\"><hr></td></tr>

                                            <tr>
                                                <td colspan=\"3\" style=\"text-align:center\">
                                                    <button class=\"btn\">Book</button>
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                                "; 
                        
                }
            }
        }

		else  {
			echo '<p style=\"color:red;\">Could not retrieve the data because: <br/>' . mysqli_error($dbc) . '</p><p>The query being run was: ' . $query . '</p>';
		}

        
        $_SESSION['route_id'] = $route_id;

		mysqli_close($dbc);
    ?>
    </div>
    </div>


 <script>
    var text = [];

    function showSeatNo(seat_selected) { 
        
        var seat_no_text = document.getElementById("seat_no_text"); 
        seat_no_text.innerHTML = seat_selected.value;

        if  (seat_selected.checked) {
            text.push(seat_selected.value);
            seat_no_text.style.display ="block";
        }
        else {
            text.splice(text.indexOf(seat_selected.value), 1);
        }
        

        document.getElementById("seat_no_text").innerHTML = text;

    }



function checkboxes() {
    var inputElems = document.getElementsByTagName("input"),
    count = 0;

    for (var i=0; i<inputElems.length; i++) {
        if (inputElems[i].type === "checkbox" && inputElems[i].checked === true) {
        
        var fare = <?php echo $fare ?>;
         
        var total = fare * count;

        document.getElementById("totalFare").innerHTML = total;

        count++;
        }

    }
    
}



</script>

</body>
</html>


