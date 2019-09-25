<?php session_start(); ?>	
<html>
		<body>
			<?php
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

				$conn = new mysqli("localhost", "nam98", "gPqls98@", "OAuth");
				$session_uid = $_SESSION['uid'];
				$session_cid = $_SESSION['cid'];
				$auth_code = randomString(10);
				
				echo $session_cid;
			
				$query = "update user set auth_code='$auth_code' where uid='$session_uid'";
				$result = mysqli_query($conn, $query);

				$query = "update client set auth_code='$auth_code' where cid='$session_cid'";
				$result = mysqli_query($conn, $query);

				$query = "insert into auth_code (code, cid, uid) values ('$auth_code','$session_cid', '$session_uid')";
				$result = mysqli_query($conn, $query);

				echo "<h1>Allow Success !</h1>";

				echo "<form action='http://192.168.56.1:5000/' method='POST'>\n";
				echo "<input type='submit' value='ok'>";
				echo "<input type='hidden' name='auth_code' value='$auth_code'>\n";
				echo "<input type='hidden' name='uid' value='$session_uid'>\n";
				echo "</form>";
		?>
			</body>
	</html>


