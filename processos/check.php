<?php
	include ("../db.php");

	if (isset($_COOKIE["user"]) && isset($_COOKIE["userKey"])) {
		$user = $_COOKIE["user"];
		$senha = $_COOKIE["userKey"];

		$check = mysqli_query($conn,"SELECT * FROM usuario WHERE email='$user' AND senha = '$senha' LIMIT 1");
		if(mysqli_num_rows($check) < 1){
			?>
			<script type="text/javascript"> location.href='Login.php'; </script>
			<?php
		}
	}else{
		?>
			<script type="text/javascript"> location.href='Login.php'; </script>
		<?php
	}
?>