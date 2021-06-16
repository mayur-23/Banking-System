
<?php
require('functions.php');
session_start();
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,"bs");

if(isset($_POST['submit']))
{
    $from = $_GET['bn'];
    $to = $_POST['to'];

    $amount = $_POST['amount'];

    $sql = "SELECT * from customers where id='$from'";
    $query = mysqli_query($connection,$sql);
    $sql1 = mysqli_fetch_array($query);

    $sql = "SELECT * from customers where id='$to'";
    $query = mysqli_query($connection,$sql);
    $sql2 = mysqli_fetch_array($query);




    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';
        echo '</script>';
    }




    else if($amount > $sql1['balance'])
    {

        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';
        echo '</script>';
    }



    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {


                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE customers set balance=$newbalance where id=$from";
                mysqli_query($connection,$sql);



                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE customers set balance=$newbalance where id=$to";
                mysqli_query($connection,$sql);

                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($connection,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='transactionhistory.php';
                           </script>";

                }

                $newbalance= 0;
                $amount =0;
        }

}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Banking System</title>
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
  .fas:hover{
    color: #ff4584;
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
                  <a class="nav-link" href="transactionhistory.php">View Transaction</a>
                </li>
              </ul>
            </div>
          </nav>

        <div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8">
            <form method="POST" name="send">
 							<h2 class="text-center pt-4" style="color : black;">Transaction</h2>
							<?php
							  $connection = mysqli_connect("localhost","root","");
							  $db = mysqli_select_db($connection,"bs");
                $sid = $_GET['bn'];
                $sql = "SELECT * FROM  customers where id='$sid'";
                $result=mysqli_query($connection,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($connection);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Balance</th>

                      </tr>
                    </thead>

                        <tr>
                          <td><?php echo $rows['name'];?></td>
                          <td><?php echo $rows['email'];?></td>
                          <td><?php echo $rows['mobile'];?></td>
                          <td><?php echo $rows['balance'];?></td>

                        </tr>

                  </table>
									<br><br><br>
									<label style="color : black;"><b>Transfer To:</b></label>
        						<select name="to" class="form-control" required>
            					<option value="" disabled selected>Choose</option>
											<?php
											$connection = mysqli_connect("localhost","root","");
											$db = mysqli_select_db($connection,"bs");
											$sid = $_GET['bn'];
					                $sql = "SELECT * FROM customers where id!='$sid'";
					                $result=mysqli_query($connection,$sql);
					                if(!$result)
					                {
					                    echo "Error ".$sql."<br>".mysqli_error($connection);
					                }
					                while($rows = mysqli_fetch_assoc($result)) {
					            ?>
											<option class="table" value="<?php echo $rows['id'];?>" >

                    <?php echo $rows['name'] ;?> (Balance:
                    <?php echo $rows['balance'] ;?> )



                </option>
											<?php
                }
            ?>
							</select>

							<br>
        <br>
            <label style="color : black;"><b>Amount:</b></label>
            <input type="number" class="form-control" name="amount" required>
            <br><br>
                <div class="text-center" >
            <button class="btn btn-primary" name="submit" type="submit" id="myBtn" >Transfer</button>
								</div>






            </form>
</div>
<!-- <div class="row">
<div class="col-md-5">

</div>

<div class="col-md-2">
	<a href="add_costomer.php">
	<button class="btn btn-primary">Add Costomer</button>
	</a>
</div>
</div> -->


  </body>
</html>
