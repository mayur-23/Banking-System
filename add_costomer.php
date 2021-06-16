<?php
	require('functions.php');
	session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Library Management System</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
      	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
      	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>


  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


        <script defer src="/your-path-to-fontawesome/js/all.js"></script>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

        <style type="text/css">
          .bg{
            width: 60%;
            justify-content: center;
          }
          .navbar{
    padding:1rem 2rem;
  }

  .title{
    font-size: 2rem;
    font-weight: 600;
  }
    .nav-item {

      padding: 0 18px;
    }

    .nav-link {
      font-size: 1.2rem;
      font-family: 'Poppins', sans-serif;
    }

    .nav-link:hover {

      border-bottom: 4px solid #ff4584;
    }

    .nav-link:active {

      border-bottom: 4px solid #ff4584;
    }
        </style>
  </head>
  <body>


    <!-- Nav Bar -->
          <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="index.php"><i class="fas fa-university fa-3x"></i></a>
            <a class="navbar-brand title" href="index.php">Banking System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="view_costomer.php">View Costomer</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="transfer.php">Transfer Money</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">View Transaction</a>
                </li>
              </ul>
            </div>
          </nav>

<div class="row">
            <div class="col-md-4"></div>
            		<div class="col-md-4">
            			<form action="" method="post">
            				<div class="form-group">
            					<label>Name</label>
            					<input type="text" name="cost_name" class="form-control" required="">
            				</div>
            				<div class="form-group">
            					<label>Email ID</label>
            					<input type="text" name="cost_email" class="form-control" required="">
            				</div>

            				<div class="form-group">
            					<label>Mobile</label>
            					<input type="text" name="cost_mobile" class="form-control" required="">
            				</div>

            				<div class="form-group">
            					<label>Balance</label>
            					<input type="text" name="cost_balance" class="form-control" required="">
            				</div>

            				<button class="btn btn-primary" name="add_Costomer">Add Costomer</button>

            			</form>
            		</div>
            		<div class="col-md-4"></div>
</div>



  </body>
</html>

<?php
	if(isset($_POST['add_Costomer'])){
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"bs");
		$query = "insert into customers values(null,'$_POST[cost_name]','$_POST[cost_email]','$_POST[cost_mobile]',$_POST[cost_balance])";
		$query_run = mysqli_query($connection,$query);
	}
?>
