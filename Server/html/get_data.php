<?php
	$cid = $_POST["cid"];
	$passwd = $_POST["passwd"];
	$redirect_url = $_POST["redirect_url"];
	$access_token = $_POST["access_token"];
	

	$conn = new mysqli("localhost", "nam98", "gPqls98@", "OAuth");

	$query = "select * from client where cid='$cid' and passwd='$passwd'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

	if($cid == $row['cid'] && $passwd == $row['passwd'] && $redirect_url == $row['redirect_url']) {
		if($access_token == $row['access_token']) {
			$query = "select uid from access_token where token='$access_token'";
			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_array($result);
			
			$uid = $row['uid'];
			$query = "select data from user where uid='$uid'";
			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_array($result);

			echo $row['data'];
		}
		else {
			echo "wrong access token";
			echo $access_token;
		}
	}
	else {
		echo "wrong client";
		echo $cid;
		echo $passwd;
		echo $redirect_url;
	}
