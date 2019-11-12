<?php
		//@session_start();
		//$_SESSION = array($_SESSION['cc_login'],$_SESSION['cc_senha'],$_SESSION['cc_nome'],$_SESSION['cc_id']);
		//unset( $_COOKIE["user"] );
		//unset( $_COOKIE["userKey"] );
?>
		<script type="text/javascript">
			document.cookie = "user=;expires=Thu, 01 Jan 1970 00:00:01 GMT";
			document.cookie = "userKey=;expires=Thu, 01 Jan 1970 00:00:01 GMT";
			location.href ='Login.php';
		</script>