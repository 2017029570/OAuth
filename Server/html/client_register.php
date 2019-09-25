<?php
	$conn = mysql_connect('localhost', 'nam98', 'gPqls98@', 'OAuth');

	if(isset($_POST['cid'])) {
		$cid = $_POST['cid'];
		$passwd = $_POST['passwd'];
		$redirect_url = $_POST['redirect_url'];

		$query = 'INSERT INTO client (cid, passwd, redirect_url) value("$cid", "$passwd", "$redirect_url")';

		mysql_query($query);

		echo "Client Register Success !";
	}
?>
