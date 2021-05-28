<?php

session_start();
include_once "connect.php";
include_once "utils.php";

if ($conn) {
	$fname = mysqli_real_escape_string($conn, $_POST['fname']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);
	if (!empty($fname) && !empty($email) && !empty($pass) && !empty(mysqli_real_escape_string($conn, $_POST['gender']))) {
		$sql1 = mysqli_query($conn, "SELECT `Email` FROM `lads` WHERE Email = '$email'");
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			if (mysqli_num_rows($sql1) > 0) {
				echo "Email Exists. Try Logging In";
			} else {
				if (isset($_FILES['image'])) {
					$img_name = $_FILES['image']['name'];
					$img_tmp_name = $_FILES['image']['tmp_name'];
					$img_explode = explode('.', $img_name);
					$img_extension = end($img_explode);
					$extensions = ['jpg', 'png', 'ico', 'webp', 'jpeg', 'gif'];
					if (in_array($img_extension, $extensions) == true) {
						$time = time();
						$new_img_name = $time . $img_name;
						$user_id = bin2hex(random_bytes(35));
						$unique_id = md5(microtime());
						$pass = encrypt($pass);
						$gender = mysqli_real_escape_string($conn, $_POST['gender']);

						$sql2 = mysqli_query($conn, "INSERT INTO `lads`(`Id`, `Unique Id`, `User Id`, `Full Name`, `Email`, `Password`, `Gender`, `Image`, `Active`) VALUES ('', '{$unique_id}', '{$user_id}', '{$fname}', '{$email}', '{$pass}', '{$gender}', '{$new_img_name}', '{$time}')");

						if ($sql2) {
							move_uploaded_file($img_tmp_name, "../img/" . $new_img_name);
							$sql3 = mysqli_query($conn, "SELECT `Email` FROM `lads` WHERE Email = '$email'");
							if (mysqli_num_rows($sql3) > 0) {
								$row = mysqli_fetch_assoc($sql3);
								$_SESSION['Unique_Id'] = $unique_id;
								echo "Success";
							} else {
								echo "Email Or Password Is Incorrect.";
							}
						} else {
							echo "Something Went Wrong" . mysqli_connect_errno() . ": " . mysqli_connect_error();
						}
					} else {
						echo "Please Select A Valid Image. Available Extensions: 'jpg', 'png', 'ico', 'webp', 'jpeg', 'gif'.";
					}
				}
			}
		} else {
			echo $email . " - Email is not valid.";
		}
	} else {
		echo "All Fields Are Required";
	}
} else {
	echo "Connection Error!";
}
