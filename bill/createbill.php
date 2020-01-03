<?php
        session_start();
	if(!isset($_SESSION['id'])){
		header("Location:./signin.php");
        }
        $month = date('m');
        $day = date('d');
        $year = date('Y');

        $today = $year . '-' . $month . '-' . $day;
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
        <div style="width:500px; margin:50px auto; border:solid #03021c 1px">
                <h4 align="center">Create Bill</h4>
                <form action="#" method="post" style="padding:20px 50px" label="Log In">
                        <label>Bill Id :</label>
                        <input type="number" name="bill_id" required>
                        <br />
                        <br />
                        <label>Cust Id :</label>
                        <input type="number" name="cust_id" required>
                        <br />
                        <br />
                        <label>Food Id :</label>
                        <input type="number" name="food_id" required>
                        <br />
                        <br />
                        <label>Quantity :</label>
                        <input type="number" name="quantity" required>
                        <br />
                        <br />
                        <label>Bill Date :</label>
                        <input type="date" name="bill_date"  required>
                        <br />
                        <br />
                        <button type="submit">Create Bill</button>
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
                        $employee_id=$_SESSION['id'];
                        $_SESSION['bill_id']=$_POST['bill_id'];
                        $_SESSION['food_id']=$_POST['food_id'];

                        $sqlbillid = "SELECT * from bill where bill_id={$_POST['bill_id']}";
                        $resultbill = $conn->query($sqlbillid);
                        $rowidbill  = mysqli_fetch_array($resultbill);
                        if(is_array($rowidbill)){
                                echo "<h4 align='center'>Id already taken.</h4>";
                        }else{
                                $sqlcustid = "SELECT * from customer where cust_id={$_POST['cust_id']}";
                                $resultcust = $conn->query($sqlcustid);
                                $rowidcust  = mysqli_fetch_array($resultcust);
                                if(!is_array($rowidcust)){
                                        echo "<h4 align='center'>customer doesn't exist.</h4>";
                                }else{
                                        $sqlfoodid = "SELECT * from food where food_id={$_POST['food_id']}";
                                        $resultfood = $conn->query($sqlfoodid);
                                        $rowidfood  = mysqli_fetch_array($resultfood);
                                        if(!is_array($rowidfood)){
                                                echo "<h4 align='center'>food doesn't exist.</h4>";
                                        }else{
                                                $sql = "INSERT INTO bill VALUES ('".$_POST['bill_id']."','".$employee_id."','".$_POST["cust_id"]."','".$_POST["food_id"]."','".$_POST["quantity"]."','".$_POST['bill_date']."')";
                                                if ($conn->query($sql) === TRUE) {
                                                        echo '<h4 align="center">New Bill Generated successfully<h4>';
                                                        echo '<h4 align="center"><a href="./previewbill.php">view bill</a></h4>';
                                                       
                                                } else {
                                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                                }
                                        }
                                }
                        }
                }
        ?>
</body>
</html>