<?php
include_once "connect.php";

$receiver_id = mysqli_real_escape_string($conn, $_POST['receiver-id']);
$message = '';

if (isset($receiver_id)) {
	$sql3 = mysqli_query($conn, "SELECT * FROM `lads` WHERE `User Id` = '$receiver_id'");
	if (mysqli_num_rows($sql3)) {
		$row3 = mysqli_fetch_assoc($sql3);
		if ($row3['Active'] > time()) {
			$active = "online";
		} else {
			$active = "";
		}

		$status = '';
		$diff = time() - $row3['Active'];
		if ($diff > 0) {
			$time = date('s\s', $diff);
			if ($diff > 60) {
				$time = date('i\m s\s', $diff);
				if ($diff > 3600) {
					$time = date('H\h i\m s\s', $diff);
					if ($diff > 86400) {
						$time = date('d\d H\h i\m s\s', $diff);
					}
				}
			}
			$status = '' . $time . ' Ago';
		} else if ($diff <= 0) {
			$status = 'Now';
		}
		$message .= "
        <div class='info'>
            <img src='resources/img/" . $row3['Image'] . "' alt='friend' />
            <span> " . $row3['Full Name'] . "
                <div class='dot " . $active . "'></div> <br>
                <div class='small'>Active " . $status . "</div>
            </span>
        </div>
        <i class='fas fa-info-circle'></i>
        ";
	} else {
		header('location: members.php?receiver-id=' . $row_shuvro_user_id . '');
	}
}

echo $message;
