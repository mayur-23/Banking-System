<?php
	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"bs");
	$query = "delete from customers where id = $_GET[bn]";
	$query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
	alert("Costomer Deleted...");
	window.location.href = "view_costomer.php";
</script>
