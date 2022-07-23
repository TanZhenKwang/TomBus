
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="icon" href="images/titleicon.png">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&family=Sofia&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>

@import url('https://fonts.googleapis.com/css2?family=Zen+Loop&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    outline: none;
    font-family: 'Quicksand', sans-serif;
}

body{
    background: #F0F8FF;
    background-size: cover;
    height: 100vh;
}


</style>
</head>

<body><?php include 'sidebar.php'; ?>
	<a href="index.php"><img src="images/tombuslogo2.png" class="logo" style="filter: grayscale(100%);opacity: 80%; transform:translateX(40px)translateY(-35px);"></a>

<?php 
	use PHPMailer\PHPMailer\PHPMailer;

	require_once 'phpmailer/Exception.php';
	require_once 'phpmailer/PHPMailer.php';
	require_once 'phpmailer/SMTP.php';

	$mail = new PHPMailer(true);
	$alert ='';

    if (isset($_POST['submitted'])) {
        $name = ($_POST['name']);
        $email = $_POST['email'];
        $msg = $_POST['msg'];
        $okay = true;

        if (empty($name) && empty($email) && empty($phoneno) && empty($msg)) {
			echo "Please fill out all the field.<br/><br/>";
			$okay = false;
		}
        else {
            if (empty($name)) {
				echo "First Name is required.<br/><br/>";
				$okay = false;
			}
            else if (ctype_alpha(str_replace(' ', '', $name)) == false) {
				echo "Only letters and spaces are allowed in Name field.<br/><br/>";
                $okay = false;
			}

            if (empty($email)) {
				echo "Email is required.<br/><br/>";	
                $okay = false;		
			}
            else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid E-mail address.<br/><br/>";
                $okay = false;
            }

            if (empty($msg)) {
                echo "Message is required.";
                $okay = false;
            }
        }
        if ($okay) {
            echo "Your message has been sent successfully.";

			try{
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'drbread2002@gmail.com'; // Gmail address which you want to use as SMTP server
				$mail->Password = 'mgwmcikftyuxocag'; // Gmail address Password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = '587';

				$mail->setFrom('drbread2002@gmail.com'); // Gmail address which you used as SMTP server
				$mail->addAddress('drbread2002@gmail.com'); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)

				$mail->isHTML(true);
				$mail->Subject = 'Message Received';
				$mail->Body = '<h3>Name: ' .$name. '<br>Email: ' .$email. '<br>Message: ' .$msg. '</h3>';

				$mail->send();
				$alert = '<div class="alert-success">
							<span>Message Sent! Thank you for contacting us.</span>
						</div>';
			}
			catch (Exception $e){
				$alert = '<div class="alert-error">
							<span>'.$e->getMessage().'</span>
						</div>';
			}
        }
    }

?>

<body>

<form action="contactus.php" method="post">
<!--Section: Contact v.2-->
<section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
        a matter of hours to help you.</p>

    <div class="col-md-12 mb-md-0 mb-3 mx-auto">

        <!--Grid column-->
        <div class="col-md-10 mb-md-0 mb-5 mx-auto">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-5">
                            <input type="text"  name="name" class="form-control" placeholder="Enter your name">
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-5">
                            <input type="text"  name="email" class="form-control" placeholder="Enter your email">
                        </div>
                    </div>
                    <!--Grid column-->

                </div>

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                            <textarea type="text" id="msg" name="msg" rows="2" class="form-control md-textarea" placeholder="Your message"></textarea>
                        </div>

                    </div>
                </div>
                <!--Grid row-->

				<br/><br/>


            <div class="text-center text-md-left">
                <input type="submit" class="btn btn-primary" value="Send Now"><input type="hidden" name="submitted" value="true">
            </div>
            <div class="status"></div>

            <br/><br/>

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="row text-center d-flex">
            <div class="col">
                <i class="fas fa-map-marker-alt fa-2x"></i>
                    <p>INTI College, Penang Malaysia</p>
            </div>



            <div class="col">
                <i class="fas fa-phone mt-12 fa-2x"></i>
                    <p>+6010 112 4574</p>
            </div>


            <div class="col">
                <i class="fas fa-envelope mt-12 fa-2x"></i>
                    <p>TomBus@gmail.com</p>
            </div> 
        </div>
        <!--Grid column-->

    </div>

</section>
<!--Section: Contact v.2-->
</form>

<script type="text/javascript">
    if(window.history.replaceState){
      window.history.replaceState(null, null, window.location.href);
    }
</script>

</body>

</html>
<?php include 'Footer.php'; ?>