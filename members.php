<?php
session_start();
include_once "resources/php/connect.php";
$Unique_Id = $_SESSION['Unique_Id'];

$sql1 = mysqli_query($conn, "SELECT * FROM `lads` WHERE `Unique Id` = '$Unique_Id'");

if (mysqli_num_rows($sql1) < 1) {
	header('location: index.php');
	die();
}
$row1 = mysqli_fetch_assoc($sql1);

$sql_shuvro = mysqli_query($conn, "SELECT * FROM `lads` WHERE `Email` = 'oh@community.com'");
$row_shuvro = mysqli_fetch_assoc($sql_shuvro);
$row_shuvro_user_id = $row_shuvro['User Id'];

if (!isset($_GET['receiver-id'])) {
	header('location: members.php?receiver-id=' . $row_shuvro_user_id . '');
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
	<title>Open Hearts: A Next Level Chatting App.</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="resources/css/mockup.css" />
	<link rel="stylesheet" href="resources/css/members.css" />
	<script src="resources/js/anime.min.js"></script>
	<link rel="shortcut icon" href="resources/img/favicon.ico" type="image/x-icon" />
</head>

<body>
	<?php
	if (!isset($_COOKIE['new_guy'])) {
		setcookie("new_guy", "", time() + 315360000);
		$_COOKIE['new_guy'] = "";
	}

	if ($_COOKIE['new_guy'] != "yes") {
		echo "
        <div class='img_panel uid active'>
            <div class='someText'>Whenever You Forget Your Password, This Id will help you. <br>
                Copy and paste it to somewhere safe.
            </div>
            <div class='timeout'>Closing In <span>10</span> seconds</div>
            <button>Copy</button>
            <textarea id='User_id' cols='30' rows='10' readonly></textarea>
        </div>
        <script>
            let uid = document.querySelector('.uid');
            let count = 10;
            let textarea = uid.querySelector('textarea'),
                counterEl = uid.querySelector('span'),
                button = uid.querySelector('button');

            uid.classList.add('active');
            textarea.value = '" . $row1['Unique Id'] . "'

            button.addEventListener('click', () => {
                textarea.select();
                document.execCommand('copy');
                button.textContent = 'Copied!';
            })

            setInterval(() => {
                count--;
                counterEl.textContent = count;
            }, 1000);
            setTimeout(() => {
                uid.remove();
                document.cookie = 'new_guy=yes; expires=" . time() + 315360000 . "';
            }, 10000);
        </script>
        ";
	}


	if ($row1['Active'] + 5 < time()) {
		echo '
		<!-- MOCKUP PAGE. -->
		<div class="mockup">
				<img src="resources/img/t-logo.png" alt="Open Heart" id="logo" />
				<div class="loader-container">
						<div class="loader"></div>
				</div>
				<div class="h-words">
						<span class="h-first">We </span>
						<span class="h-first">Know </span>
						<span class="h-first">How </span>
						<span class="h-first">To </span>
						<span class="h-second">We </span>
						<span class="h-second">Are </span>
				</div>
				<div class="main-name">
						<span class="red">O</span>
						<span class="seen">pen&nbsp;</span>
						<span class="hidden">Our&nbsp;</span>
						<span class="red">H</span>
						<span class="seen">earts</span>
				</div>
		</div>
		<script>
				let animation = anime
						.timeline({
								delay: 500,
								complete: (anime) => {
										document.querySelector(".mockup").remove();
								}
						})
						.add({
								targets: "#logo",
								duration: 2000,
								top: ["50vh", 0],
								opacity: [0, 1],
						})
						.add({
								targets: ".mockup .h-words .h-first",
								duration: 10,
								opacity: [0, 1],
								delay: anime.stagger(500, {
										start: 500
								}),
						})
						.add({
								targets: ".mockup .main-name > *",
								duration: 1000,
								letterSpacing: 1,
								easing: "easeOutBack",
								delay: anime.stagger(500, {
										start: 500
								}),
						})
						.add({
								targets: ".mockup .h-words .h-second",
								duration: 10,
								opacity: [0, 1],
								delay: anime.stagger(500, {
										start: 500
								}),
						})
						.add({
								targets: ".mockup .main-name .hidden",
								letterSpacing: "-7vw",
								easing: "easeOutBack",
								duration: 1000,
								delay: 1000,
						})
						.add({
								targets: ".mockup",
								duration: 750,
								opacity: [1, 0],
						});

				let animate2 = anime
						.timeline({
								easing: "easeOutQuint"
						})
						.add({
								targets: ".loader",
								width: [0, "calc(100% - 10px)"],
								duration: 15000,
						})


				setInterval(() => {
						console.log(' . $row1['Active'] + 5 . ', ' . time() . ')
						let xhr = new XMLHttpRequest();
						xhr.open("POST", "resources/php/check_connected.php", true);
						xhr.send();
				}, 5000);
		</script>
		';
	} else {
		echo '
			<script>
					setInterval(() => {
							console.log(' . $row1['Active'] + 5 . ', ' . time() . ')
							let xhr = new XMLHttpRequest();
							xhr.open("POST", "resources/php/check_connected.php", true);
							xhr.send();
					}, 5000);
			</script>
			';
	}
	?>



	<div class="menu-wrapper">
		<div class="hamburger-menu"></div>
	</div>
	<div class="form shadow inactive" id="nav">
		<?php
		echo "
            <div class='your_id'>
                <img src='resources/img/" . $row1['Image'] . "' alt='Your Profile' />
                <span class='your_name'>" . $row1['Full Name'] . "</span>
                <a href='resources/php/logout.php?logout_id=" . $row1['User Id'] . "' class='button'>Log Out</a>
            </div>";
		?>
		<div class="search_bar">
			<div class="inp_field shadow">
				<input class="inp" id="search" type="email" name="search" />
				<label for="search">
					<i class="fas fa-search"></i>
				</label>
			</div>
		</div>
		<div class="members">

		</div>
	</div>
	<div class="messages shadow">
		<header></header>

		<main>
			<div class="user_message">Please Wait...</div>
		</main>

		<?php
		$receiver_id = $_GET['receiver-id'];
		?>

		<form class="footer" autocomplete="off" enctype="multipart/form-data">
			<label for="send_image"><i class="far fa-file-image"></i></label>
			<i class="far fa-grin-alt"></i>
			<input type="file" name="send_image" id="send_image" accept="image/*" hidden>
			<input type="text" name="sender-id" value="<?php echo $row1['User Id']; ?>" readonly hidden>
			<input type="text" name="receiver-id" value="<?php echo $receiver_id; ?>" readonly hidden>
			<div class="inp_field shadow">
				<input class="inp" type="text" name="send-message" />
			</div>
			<input type="submit" value="" hidden id="submit" />
			<label for="submit">
				<!-- <i class="fas fa-thumbs-up"></i> -->
				<i class="fab fa-google-play"></i>
			</label>
		</form>
	</div>
	<div class="img_panel">
		<img id="preview" />
		<label for="submit">
			<i class="fas fa-check-circle" style="right: 40px;"></i>
		</label>
		<i class="fas fa-times-circle"></i>
	</div>

	<script src="resources/js/emoji.min.js"></script>
	<script src="resources/js/members.js"></script>
	<script src="resources/js/see_photo.js"></script>
	<script src="resources/js/main.js"></script>
</body>

</html>