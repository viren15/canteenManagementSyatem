<?php
        session_start();
	if(!isset($_SESSION['id'])){
		header("Location:./signin.php");
	}
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
                <a href="../home.php">Home</a>
		<a href="./addfood.php">Add Food</a>
		<a href="./fetchfood.php">Fetch Food Info</a>
                <a href="./updatefood.php">Update Food Price</a>
                <a href="./removefood.php">Remove Item</a>
		<a href="../logout.php">logout</a>
	</div>
	<div><div style="width:100%; margin:0px auto;">
		<h2 align="center">Canteen Management System : Food<h2>
	</div>
	<hr />
	<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
        <div style="width:500px; margin:50px auto; border:solid #03021c 1px">
                <h4 align="center">Add food</h4>
                <form action="#" method="post" style="padding:20px 50px" label="Log In">
                        <label>Food Id :</label>
                        <input type="number" name="food_id" required>
                        <br />
                        <br />
                        <label>Food Type :</label>
                        <input type="text" name="food_type" required>
                        <br />
                        <br />
                        <label>Food Name :</label>
                        <input type="text" name="food_name" required>
                        <br />
                        <br />
                        <label>Food Description :</label>
                        <input type="text" name="food_desc" required>
                        <br />
                        <br />
                        <label>Food Price :</label>
                        <input type="number" name="food_price" required>
                        <br />
                        <br />
                        <label>Food Preparation Time :</label>
                        <input type="number" name="food_preptime" required>
                        <br />
                        <br />
                        <button type="submit">Add Item</button>
                        <br />
                        
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
                        $sqlid = "SELECT * from food where food_id={$_POST['food_id']}";
                        $result = $conn->query($sqlid);
                        $rowid  = mysqli_fetch_array($result);
                        if(is_array($rowid)){
                                echo "<h4 align='center'>Id already taken.</h4>";
                        }else{  
                                $sql = "INSERT INTO food VALUES ('".$_POST['food_id']."','".$_POST["food_type"]."','".$_POST["food_name"]."','".$_POST["food_desc"]."','".$_POST["food_price"]."','".$_POST['food_preptime']."','".true."')";
                                if ($conn->query($sql) === TRUE) {
                                        echo '<h4 align="center">New Item added successfully<h4>';
                                } else {
                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                        }
                }
        ?>
</body>
</html>