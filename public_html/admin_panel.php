<html>
<head>
    </title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
    
    <style type="text/css">
    .content {
        width: 80%;
        margin: auto;
        border: 1px solid #cbcbcb;
        padding: 50px;
        border-radius: 20px;
    }


    </style>

<body>
<?php
$realm = 'Restricted area';

//user => password
$users = array('admin' => 'mypass');


if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Digest realm="'.$realm.
           '",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"');

    die('Text to send if user hits Cancel button');
}


// analyze the PHP_AUTH_DIGEST variable
if (!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) ||
    !isset($users[$data['username']]))
    die('Wrong Credentials!');


// generate the valid response
$A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
$A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);
$valid_response = md5($A1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2);

if ($data['response'] != $valid_response)
    die('Wrong Credentials!');

// ok, valid username & password
echo 'You are logged in as: ' . $data['username'];


// function to parse the http auth header
function http_digest_parse($txt)
{
    // protect against missing data
    $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
    $data = array();
    $keys = implode('|', array_keys($needed_parts));

    preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

    foreach ($matches as $m) {
        $data[$m[1]] = $m[3] ? $m[3] : $m[4];
        unset($needed_parts[$m[1]]);
    }

    return $needed_parts ? false : $data;
}
?>


<?php
    //connect database
	$dbc = mysqli_connect('localhost', 'root', '');

	if (!$dbc) {
		die("Error: " . mysqli_connect_error($dbc));
	}

    mysqli_select_db($dbc, 'busplan');

    $msg = "";

    if (isset($_POST['busUploaded'])) {

        // Get all the submitted data from the from
        $bus_name = $_POST['bus_name'];
            
        // Get image name
        $bus_logo = $_FILES['bus_logo']['name'];

        // image file directory
        $target = "images/".basename($bus_logo);

        //stores the submmited data into the database
        $query = "INSERT INTO bus (bus_id, bus_name, bus_logo)
                VALUES (0, '$bus_name', '$bus_logo')";

		if (mysqli_query($dbc, $query)) {
			echo "New bus uploaded successfully!<br/>";
		}
        else {
            echo "Error: " . mysqli_error($dbc);
        }

        //Upload image
        if (move_uploaded_file($_FILES['bus_logo']['tmp_name'], $target)) {
            $msg= "Image uploaded successfully!";
        }
        
        else {
            $msg= "Failed to upload image.";
        }

        echo $msg;
        
        //close the database
        mysqli_close($dbc);

	} //End of bus form submission if.

    if (isset($_POST['busrouteUploaded'])) {
        //connect database
        $dbc = mysqli_connect('localhost', 'root', '');

        if (!$dbc) {
            die("Error: " . mysqli_connect_error($dbc));
        }

        mysqli_select_db($dbc, 'busplan');

        $departure = $_POST['departure'];
        $destination = $_POST['destination'];
        $date = $_POST['date'];
        $departure_time = $_POST['departure_time'];
        $arrival_time = $_POST['arrival_time'];
        $fare = $_POST['fare'];
        $bus_id = $_POST['bus'];

        $query = "INSERT into busroute (route_id, departure, destination, date, departure_time, arrival_time, fare, bus_id)
                  VALUES (0, '$departure', '$destination', '$date', '$departure_time', '$arrival_time', '$fare', '$bus_id')";
    
		if (mysqli_query($dbc, $query)) {
			echo "New bus route uploaded successfully!";
		}
        else {
            echo "Error: " . mysqli_error($dbc);
        }

        //close the database
        mysqli_close($dbc);
    }

    
?>
<div class="col-sm-50 col-lg-10 d-flex justify-content-center align-items-center flex-column">
<div class="content">
    <h1>New Bus</h1>
	<form action="admin_panel.php" method="post" enctype="multipart/form-data">

        <!--Bus ID: <input type="text" name="bus_id"><br/><br/>-->
        <br/><br/>
        <input class="form-control" type="text" name="bus_name" placeholder="Bus Name" aria-label="default input example">
        
        <br/><br/>

        <div class="mb-3">
            <label for="formFile" class="form-label">Bus Logo:</label>
            <input class="form-control" type="file" name="bus_logo" id="formFile">
        </div><br/>
        <br/><br/>

        <input type="submit" name="submit">
		<input type="hidden" name="busUploaded" value="true">
    </form>


    <br/><hr><br/><br/>

    <h1>New Bus Route</h1>

    <br/><br/>

    <form action="admin_panel.php" method="post">
        <input class="form-control" type="text" name="departure" placeholder="Departure" aria-label="default input example">
        
        <br/><br/>

        <input class="form-control" type="text" name="destination" placeholder="Destination" aria-label="default input example">
        
        <br/><br/>

        <input class="form-control" type="date" name="date" placeholder="Date" aria-label="default input example">
        
        <br/><br/>

        <input class="form-control" type="time" name="departure_time" placeholder="Departure Time" aria-label="default input example">
        
        <br/><br/>

        <input class="form-control" type="time" name="arrival_time" placeholder="Arrival Time" aria-label="default input example">

        <br/><br/>

        <input class="form-control" type="text" name="fare" placeholder="Fare" aria-label="default input example">
        
        <br/><br/>

        <input class="form-control" list="buses" name="bus" id="bus" placeholder="Bus" aria-label="default input example">
            
        <br/><br/>
            <datalist id="buses">
            <?php 
                //connect database
                $dbc = mysqli_connect('localhost', 'root', '');

                if (!$dbc) {
                    die("Error: " . mysqli_connect_error($dbc));
                }

                mysqli_select_db($dbc, 'busplan');

                $query = "SELECT bus_id, bus_name FROM bus";

                if ($r = mysqli_query($dbc, $query)) {
                    while ($row = mysqli_fetch_array($r)) {
                        echo "<option value=\"{$row['bus_id']}\">
                                {$row['bus_name']}</option>";
                    }
                }
                else {
                   echo "Error: " . mysqli_error($dbc); 
                }
            ?>
            </datalist>

        <br/><br/><br/>
        <input type="submit" name="submit">
		<input type="hidden" name="busrouteUploaded" value="true">
    </form>
</div></div>

</body>
</html>
