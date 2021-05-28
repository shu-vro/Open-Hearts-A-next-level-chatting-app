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
	<link rel="stylesheet" href="resources/css/mockup.css" />
	<link rel="stylesheet" href="resources/css/style.css" />
	<link rel="shortcut icon" href="resources/img/favicon.ico" type="image/x-icon" />
</head>

<body>
	<form class="shadow form" autocomplete="off">
		<h2>Login:</h2>
		<div class="msg error">Lorem ipsum dolor sit amet.</div>
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
					*Required
				</span>
			</i>
			<input class="inp" required type="password" name="pass" placeholder="Password" />
			<i class="far fa-eye"></i>
		</div>

		<div class="inp_field shadow">
			<input type="submit" value="Sign In" />
		</div>
		<a href="forgot_password.php" class="normalBtn">Forgot Password?</a>
		Or New Here? Try <a href="register.php" class="normalBtn">Signing In</a>
	</form>
	<script src="resources/js/main.js"></script>
	<script>
		let form = document.querySelector("form"),
			submit = document.querySelector("input[type=submit]"),
			msg = document.querySelector(".msg");

		form.addEventListener("submit", (e) => {
			e.preventDefault();
		});

		let shadow = "";
		for (let i = 0; i < 700; i++) {
			shadow += `${i}px ${i}px 0px #00000003, `;
		}
		form.setAttribute(
			"style",
			`box-shadow: ${shadow} -3px -3px 15px #fff, -5px -5px 20px #fff;`
		);

		submit.addEventListener("click", () => {
			let xhr = new XMLHttpRequest();
			xhr.open("POST", "resources/php/check_logged.php", true);
			xhr.addEventListener("readystatechange", () => {
				if (xhr.readyState == 4 && xhr.status == 200) {
					let data = xhr.response;
					if (data == "Success") {
						location.href = "members.php";
					}
					msg.style.display = 'block';
					msg.textContent = data;
				}
			});
			xhr.send(new FormData(form));
		});
	</script>

</body>

</html>