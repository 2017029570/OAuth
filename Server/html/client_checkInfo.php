<?php
	session_start();
	$conn = new mysqli('localhost', 'nam98', 'gPqls98@', 'OAuth');
	if(!$conn) {
		die('error : '.mysql_error());
	}

	
	$cid = $_POST['cid'];
	$passwd = $_POST['passwd'];
	$redirect_url = $_POST['redirect_url'];

	$query = "select * from client where cid='$cid' and passwd='$passwd' and redirect_url='$redirect_url'";

//	$query = "select * from client";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	


	if($cid==$row['cid'] && $passwd==$row['passwd']) { 
		$_SESSION['cid'] = $cid;
		//echo "<script> location.href='http://localhost/user_login.html';</script>";
		echo "<form action='http://localhost/user_login.html' method='POST' name='form'>";
		echo "<script> document.form.submit(); </script>";
		echo "</form>";
//		echo "yes";
//		echo "<a href='http://localhost/user_login.html'>";
//		header("Location : http://localhost/user_login.html");

	}
	else {
		echo "<script> history.back();</script>";
	}
?>
