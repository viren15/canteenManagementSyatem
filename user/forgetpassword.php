<?php
        session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
                button {
                        border: none;
                        outline: 0;
                        display: inline-block;
                        padding: 4px;
                        color: white;
                        background-color: #03021c;
                        text-align: center;
                        cursor: pointer;
                        width: 100%;
                        font-size: 16px;
                }
                button:hover, a:hover {
                        opacity: 0.6;
                }
                body {
			font-family: "Lato", sans-serif;
		}

		.sidenav {
			height: 100%;
			width: 0;
			position: fixed;
			z-index: 1;
			top: 0;
			left: 0;
			background-color: #111;
			overflow-x: hidden;
			transition: 0.5s;
			padding-top: 60px;
		}

		.sidenav a {
			padding: 8px 8px 8px 32px;
			text-decoration: none;
			font-size: 25px;
			color: #818181;
			display: block;
			transition: 0.3s;
		}

                form a {
                        text-decoration: none;
                        font-size: 12px;
                        color: blue;
                }

		.sidenav a:hover {
			color: #f1f1f1;
		}

		.sidenav .closebtn {
			position: absolute;
			top: 0;
			right: 25px;
			font-size: 36px;
			margin-left: 50px;
		}

		@media screen and (max-height: 450px) {
			.sidenav {padding-top: 15px;}
			.sidenav a {font-size: 18px;}
		}
                form {
                overflow: hidden;
                }
                input {
                float: right;
                clear: both;
                }
        </style>
</head>
<body>
        <div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="#">food</a>
		<a href="#">customers</a>
		<a href="#">bill</a>
		<a href="#">stock</a>
		<a href="#">logout</a>
	</div>
	<div><div style="width:100%; margin:0px auto;">
		<h2 align="center">Canteen Management System : User<h2>
	</div>
	<hr />
	<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
        <div style="width:400px; margin:50px auto; border:solid #03021c 1px">
                <h4 align="center">User Sign Up</h4>
                <form action="#" method="post" style="padding:20px 50px" label="Log In">
                        <label>Email </label>
                        <input type="email" name="email" required>
                        <br />
                        <br />
                        <button type="submit">Sign Up</button>
                        <br />
                        <a href="..\signin.php">already have an account?</a>
                </form>
        </div>
        <script>
		function openNav() {
			document.getElementById("mySidenav").style.width = "250px";
		}

		function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
		}
	</script>
        <?php
                $conn = mysqli_connect("localhost", "root", "root", "canteen");
                if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                }
                if($_SERVER["REQUEST_METHOD"] == "POST"){

                        $sql = "SELECT * from user where email='".$_POST['email']."'";
                        $result = $conn->query($sql);
                        $row  = mysqli_fetch_array($result);
                        if(is_array($row)) {
                                require 'phpmailer/PHPMailerAutoload.php';
                                $mail = new PHPMailer(true);
                               
                                $mail->setFrom('vkathiriya15@gmail.com');
                                $mail->addAddress($row['email']);
                                $mail->Subject = 'Password for CMS.';
                                $msg = "<h4 align='center'>Name: '".$row["username"]."'</h4> <br> Email: '".$row["email"]."'";
                                $msg .= "Your Current Password is '".$row['password']."'.<hr /> Thank you.";
                                $mail->Body = $msg;

                                $mail->isHTML(true);
                                $mail->IsSMTP();
                                $mail->SMTPSecure = 'ssl';
                                $mail->Host = 'ssl://smtp.gmail.com';
                                $mail->SMTPAuth = true;
                                $mail->Port = 465;
                                
                                
                                $mail->Username='vkathiriya15@gmail.com';
                                $mail->Password='Viren@1234@';
                                if(!$mail->send()){
                                        echo "Message could not be sent."; 
                                }else{
                                        echo "<h4 align='center'>password is sent to registered email.";
                                }
                        } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                }
        ?>
</body>
</html>