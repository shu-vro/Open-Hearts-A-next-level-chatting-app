<?php
session_start();
include_once "resources/php/connect.php";
if (isset($_SESSION['Unique_Id'])) {
	$Unique_Id = $_SESSION['Unique_Id'];

	$sql1 = mysqli_query($conn, "SELECT * FROM `lads` WHERE `Unique Id` = '$Unique_Id'");

	// Need to change
	if (!empty($Unique_Id) || (mysqli_num_rows($sql1) > 0)) {
		header('location: index.php');
		die();
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="keywords" content="Document" />
	<meta name="description" content="Your Description..." />
	<title>Document</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="resources/css/style.css" />
	<link rel="shortcut icon" href="resources/img/favicon.ico" type="image/x-icon" />
</head>

<body>
	<form class="shadow form" autocomplete="off">
		<h2>Register:</h2>
		<div class="msg error">Lorem ipsum dolor sit amet.</div>
		<div class="inp_field shadow">
			<i class="fas fa-user">
				<span>
					<h3>Full Name:</h3>
					*Required
				</span>
			</i>
			<input class="inp" required type="text" name="fname" placeholder="Full Name" />
		</div>
		<div class="inp_field shadow">
			<i class="fas fa-envelope">
				<span>
					<h3>Email:</h3>
					*Required and must be unique.
				</span>
			</i>
			<input class="inp" required type="email" name="email" placeholder="Email" />
		</div>
		<div class="inp_field shadow">
			<i class="fas fa-lock">
				<span>
					<h3>Password:</h3>
					*Required <br>
					Requirements:
					<h3>
						Uppercase,<br> Lowercase,<br> Number,<br> Minimum 8 characters.
					</h3>
				</span>
			</i>
			<input class="inp" required type="password" name="pass" placeholder="Password" />
			<i class="far fa-eye"></i>
		</div>
		<div class="inp_field shadow">
			<i class="fas fa-venus-mars">
				<span>
					<h3>Gender:</h3>
					*Required
				</span>
			</i>
			<input type="radio" id="m" name="gender" value="male" />
			<label for="m">Male</label>
			<input type="radio" id="f" name="gender" value="female" />
			<label for="f">Female</label>
			<input type="radio" id="o" name="gender" value="others" />
			<label for="o">Others</label>
		</div>
		<div class="inp_field shadow">
			<i class="fas fa-images">
				<span>
					<h3>Image:</h3>
					*Required
				</span>
			</i>
			<input type="file" name="image" id="image" required />
			<label for="image">Choose A Image File</label>
		</div>
		<div class="inp_field shadow">
			<input type="submit" value="Sign In" />
		</div>
		One of us? Try <a href="index.php" class="normalBtn">Logging In</a>
	</form>
	<div class="img_panel">
		<img id="preview" />
		<i class="fas fa-times"></i>
	</div>

	<script src="resources/js/see_photo.js"></script>
	<script src="resources/js/main.js"></script>
	<script src="resources/js/pass_strength.js"></script>
	<script>
		let form = document.querySelector("form"),
			msg = document.querySelector(".msg");

		form.addEventListener("submit", (e) => {
			e.preventDefault();
		});

		let shadow = '';
		for (let i = 0; i < 700; i++) {
			shadow += `${i}px ${i}px 0px #00000003, `;
		}
		form.setAttribute('style', `box-shadow: ${shadow} -3px -3px 15px #fff, -5px -5px 20px #fff;`);

		let submit = document.querySelector("input[type=submit]");

		submit.addEventListener("click", () => {
			let xhr = new XMLHttpRequest();
			xhr.open("POST", "resources/php/check_signed.php", true);
			xhr.addEventListener("load", () => {
				if (xhr.readyState == 4 && xhr.status == 200) {
					let data = xhr.response;
					if (data == "Success") {
						location.href = 'members.php';
					} else {
						msg.style.display = "block";
						msg.textContent = `${data}`;
					}
				}
			});
			xhr.send(new FormData(form));
		});
	</script>
</body>

</html>