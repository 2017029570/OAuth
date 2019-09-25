<?php
	session_start();
	$uid = $_POST['uid'];
	$passwd = $_POST['passwd'];
	$cid = $_SESSION['cid'];
	$conn = new mysqli('localhost', 'nam98', 'gPqls98@', 'OAuth');

	$query = "select * from user where uid='$uid' and passwd='$passwd'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

	if($uid==$row['uid'] && $passwd==$row['passwd']) {
		$_SESSION['uid']=$row['uid'];
		$_SESSION['cid']=$cid;
		echo $_SESSION['cid'];
		header("Location: http://localhost/user_access.html");
	}
	else {
		echo "WRONG INFO";
	}
?>
