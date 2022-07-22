<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - User</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	
    <style>
	body {
		background-image: linear-gradient(white, #d3e4f0);
	}

      .success-signup {
        position: absolute;
        width: 400px;
        height: 400px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        backdrop-filter:blur(200px);
        background-color: rgba(800, 800, 300, 0.364);
        border-radius:20px;
        z-index: 3;
      }


      @media(max-width:350px){
        
		.side-bar {
			position: fixed;
			max-width: 50px;
			height: 300px;
			left:5px;
			padding-left:200px;
			
		}

        .acc-container {
            padding-right:80px;
            max-bottom:100px;
        }

        .side-bar ul{
            max-width:100px;
            height:10px;
            padding-right:300px;
            top:100px;
        }

		.side-bar-content {
			position: fixed;
			max-width: 200px;
			height: 300px;
			left:5px;
			padding-left:50px;
			
		}

      }

    </style>

<body>

<?php include "sidebar.php"?> 
 <?php
    
	$emailErr= $pwErr= "";
	$okay = true;
	
	if (isset($_POST['submitted'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "* Invalid E-mail address";
                $okay = false;
            }

    if ($okay) {
        //connect database
        $dbc = mysqli_connect('localhost', 'root', '');
        mysqli_select_db($dbc, 'busplan');

        //retrieve and check whether this email and password is exist
        $query = "SELECT * FROM user WHERE email = '$email'";

        if ($result = mysqli_query($dbc, $query)) {
            if (mysqli_num_rows($result) == 0) {
                $emailErr = "* Couldn't find that E-mail address. Check the spelling and try again.";
                $okay = false;
            }
            else {
                $query = "SELECT * FROM user WHERE email='$email' AND password=MD5('$password')";
                $result = mysqli_query($dbc, $query);
					
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        
                        $_SESSION['user_info'] = "SELECT * FROM user WHERE email ='$email'";
                        $_SESSION['user_id'] = $row['user_id'];
                        echo '
                            <div class="successbg">
                                <div class="success-signup">
                                    <h1>Hi</h1>
                                    <h1>Welcome to Bus Plan!</h1>
                                    <p>We are happy to have you on board. </p>
                                    <br/><br/>
                                    <a href="index.php"><button class="btn">Great!</button></a>  
                                </div>
                            </div>
                        ';
                    }
                }
    
                //query did not run
                else {
                    echo "Fail to sign up because: <br/>" . mysqli_error($dbc) . "The query was: " . $query;
                }
                }
        }
         
        
        //close database
        mysqli_close($dbc);
    }
}
    ?>

<br/><br/><br/><br/><br/>
<div class="row border col-7 d-flex justify-content-center align-items-center mx-auto" 
style="border-radius:20px;box-shadow: -1px 1px 30px 2px rgba(143,159,209,0.44);"> 

    <div class="col-sm-12 col-lg-6 p-5 d-flex justify-content-center align-items-center" style="background:rgba(255, 255, 255, 0.583);border-radius:20px">
      <img src="images/icon-bus.png">
    </div>
    
    <div class="col-sm-12 col-lg-6 d-flex justify-content-center align-items-center flex-column">
      <br/>
    <h1>Login</h1>
	<form action="userlogin.php" method="post">
        <br/><br/>
        <div class="col-12 mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
            <span style="color:#e80909"><?php echo $emailErr; ?></span>
          </div>
          <div class="col-12 mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span style="color:#e80909"><?php echo $pwErr; ?></span>
        </div>
    <br/><br/>

        <div class="col-sm-12 col-lg-6 d-flex justify-content-center">
    <input type="submit" value="Login" class="btn btn-primary text-light" style="box-shadow: -1px 9px 14px 1px rgba(143,159,209,0.66);">
        <input type="hidden" name="submitted" value="true">
    </div>

      <br/><br/>
      <p class="small text-center"> Not a member?  <a href="userregister.php">Register now</a></p>
    </form>
    </div>
    </div>
	<br/><br/><br/>
    <?php include "Footer.php"?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
    </html>