<?php
        session_start();
        unset($_SESSION["sesid"]);
        $conn = mysqli_connect("localhost", "root", "root", "canteen");
        if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
                        opacity: 0.7;
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
		<h2 align="center">Canteen Management System<h2>
	</div>
	<hr />
	<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
        <div style="width:400px; margin:50px auto; border:solid #03021c 1px">
                <h4 align="center">User Login</h4>
                <form action="#" method="post" style="padding:20px 50px" label="Log In">
                        <label>Username :</label>
                        <input type="text" name="username" required>
                        <br />
                        <br />
                        <label>Password &nbsp:</label>
                        <input type="password" name="password" required>
                        <br />
                        <br />
                        <button type="submit">login</button>
                        <br />
                        <a href="user\signup.php">new user?</a>
                        <br />
                        <a href="user\forgetpassword.php">forgot password?</a>
                </form>
                
        </div>
        <script>
		function openNav() {
                        $('#mySidenav').width(250);
		}

		function closeNav() {
                        $('#mySidenav').width(0);
		}
	</script>
        <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $sql = "SELECT * FROM user WHERE username='" . $_POST["username"] . "' and password = '". $_POST["password"]."'";
                        $result = $conn->query($sql);
                        $row  = mysqli_fetch_array($result);
                        if(is_array($row)) {
                                $_SESSION["id"] = $row['id'];
                                $_SESSION["username"] = $row['username'];
                                if(isset($_SESSION["id"])) {
                                        header("Location:.\home.php");
                                }
                        } else {
                                echo "<h4 align='center'>Invalid Username or Password!<h4>";
                        }
                }
                
        ?> 
</body>
</html>