<?php
        session_start();
	if(!isset($_SESSION['id'])){
		header("Location:../signin.php");
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
                .card {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                max-width: 300px;
                margin: auto;
                text-align: center;
                }
                .card p{
                        margin-left:30px;
                }
                .title {
                color: grey;
                font-size: 18px;
                }
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
                .card h4 {
                        align: right;
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
		<a href="./createbill.php">New Bill</a>
                <a href="./fetchbill.php">Fetch Bill</a>
                <a href="./fetchByCustomer.php">Fetch Customer Bills</a>
		<a href="../logout.php">logout</a>
	</div>
	<div><div style="width:100%; margin:0px auto;">
		<h2 align="center">Canteen Management System : Bill<h2>
	</div>
	<hr />
	<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
        <div style="width:400px; margin:50px auto; border:solid #03021c 1px">
                <h4 align="center">Fetch Info</h4>
                <form action="#" method="post" style="padding:20px 50px" label="Log In">
                        <label>Customer Id:</label>
                        <input type="number" name="cust_id" required>
                        <br />
                        <br />
                        <button type="submit">Fetch Bills</button>
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
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $conn = mysqli_connect("localhost", "root", "root", "canteen");
                        if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                        }
                        $sql = "SELECT * FROM bill WHERE cust_id={$_POST["cust_id"]}";
                        $result = $conn->query($sql);
                        $total_profit=0;
                        if ($result->num_rows > 0) {
                                echo "<p align='center'><b>$result->num_rows.</b> result found.</p>";
                                while($row = $result->fetch_assoc()) {
                                        echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
                                        <div class='card' style='padding-bottom:30px margin-left:30px;'>
                                        <hr />
                                        <p align='left'><b>Bill Id:</b> {$row["bill_id"]}</p>
                                        <p align='left'><b>Employee Id Id: </b>{$row["employee_id"]}</p >
                                        <p align='left'><b>Customer Id : </b>{$row["cust_id"]}</p >
                                        <p align='left'><b>Food Id: </b>{$row["food_id"]}</p >
                                        <p align='left'><b>Quantity: </b>{$row["quantity"]}</p>
                                        <p align='left'><b>Date: </b>{$row["bill_date"]}</p>
                                        <hr />
                                        </div>";
                                        $sqlfood = "SELECT * FROM food WHERE food_id={$row["food_id"]}";
                                        $resultfood = $conn->query($sqlfood);
                                        $rowfood  = mysqli_fetch_array($resultfood);
                                        if(is_array($rowfood)){
                                                $perFoodCost = $rowfood['food_price'];
                                        }else{
                                                echo "<h4 align='center'>Unkonwn Error!<h4>";
                                        }
                                        $total_profit += $row['quantity'] * $perFoodCost;
                                        
                                }
                                echo "<h4 align='center'>Toatl Buy: $total_profit$</h4>";
                        }else {
                                echo "<h4 align='center'>No results</h4>";
                        }
                        $conn->close();
                }
        ?>
</body>
</html>