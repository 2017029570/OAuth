<?php
	session_start();
	function randomString($length) {
			$str = 'abcdefghijklmnopqrstuvwxvz0123456789!@#$%^&*ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$max = strlen($str) - 1;
			$chr = '';
			$len = abs($length);
	
			for($i=0; $i<$len; $i++) {
				$chr .= $str[random_int(0, $max)];
			}
			return $chr;
	}

	$cid = $_POST['cid'];
	$passwd = $_POST['passwd'];
	$redirect_url = $_POST['redirect_url'];
	$auth_code = $_POST['auth_code'];

	$conn = new mysqli('localhost', 'nam98', 'gPqls98@', 'OAuth');

	$query = "select * from client where cid='$cid' and passwd='$passwd' and redirect_url='$redirect_url'";

	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

	if($cid == $row['cid'] && $passwd == $row['passwd'] && $redirect_url == $row['redirect_url']) {
//		$query = "select user.data from user join client on user.auth_code = '$auth_code' and user.auth_code = client.auth_code";
		$query = "select uid from auth_code where code='$auth_code'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result);
		
		if($_POST['uid'] == $row['uid']) {
			$uid = $_POST['uid'];
			$access_token = randomString(20);
			$query = "update client set access_token='$access_token' where cid = $cid";
			$result = mysqli_query($conn, $query);
			
			$query = "insert into access_token(token, uid, cid) values ('$access_token', '$uid', '$cid')";
			$result = mysqli_query($conn, $query);

			$callback = $redirect_url."token_callback"; 
			echo "<html>\n";
			echo "<body>\n";
			echo "<form action='$callback' method='POST' name='form'>\n";
			echo "<input type='hidden' name='access_token' value='$access_token'>\n";
			echo "<script>document.form.submit();</script>";
			echo "</form>\n";
			echo "</body>\n";
			echo "</html>\n";

			
		}
		else {
			echo "wrong user information";
		}
	}
	else {
		echo "wrong client information";
	}
?>

