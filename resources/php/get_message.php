<?php
session_start();
$message = "";
if (isset($_SESSION['Unique_Id'])) {
    include_once "connect.php";
    include_once "utils.php";
    if ($conn) {
        $sender_id = mysqli_real_escape_string($conn, check($_POST['sender-id'])); // User id
        $receiver_id = mysqli_real_escape_string($conn, check($_POST['receiver-id']));

        $sql = mysqli_query($conn, "SELECT * FROM `messages` WHERE (`sender_id` = '$sender_id' AND `receiver_id` = '$receiver_id') OR (`sender_id` = '$receiver_id' AND `receiver_id` = '$sender_id') ORDER BY `Id`");
        $sql2 = mysqli_query($conn, "SELECT * FROM `lads` WHERE `User Id` = '$sender_id'");
        $row2 = mysqli_fetch_assoc($sql2);
        $sql3 = mysqli_query($conn, "SELECT * FROM `lads` WHERE `User Id` = '$receiver_id'");
        $row3 = mysqli_fetch_assoc($sql3);
        if (mysqli_num_rows($sql) > 0) {
            while ($row = mysqli_fetch_assoc($sql)) {
                if (substr($row['Message'], 0, 27) == "specialImageFileToBeSaved.:") {
                    $actual_message = substr($row['Message'], 27);
                    $actual_message =
                        "
                        <a href='resources/img/" . substr($row['Message'], 27) . "' target='_blank'>
                            <img src='resources/img/" . substr($row['Message'], 27) . "' class='message_img'>
                        </a>
                        ";
                } else {
                    $actual_message = $row['Message'];
                }
                if ($row['sender_id'] == $sender_id) {
                    $message .= '
                    <div class="message message-sender">
                        <div class="inner-message">
                            <div class="text">
                                <span>
                                ' . $actual_message . '
                                </span>
                                <div class="time">' . $row["Time"] . '</div>
                            </div>
                            <img src="resources/img/' . $row2['Image'] . '" alt="me" />
                        </div>
                    </div>
                    ';
                } else {
                    $message .= '
                    <div class="message message-receiver">
                        <div class="inner-message">
                            <img src="resources/img/' . $row3['Image'] . '" alt="me" />
                            <div class="text">
                                <span>' . $actual_message . '</span>
                            </div>
                            <div class="time">' . $row["Time"] . '</div>
                        </div>
                    </div>
                    ';
                }
            }
        }
    } else {
        $message = "<div class='user_message'>Disconnected From Database. Try To Reconnected And Join Again.</div>";
    }
} else {
    header("location: ../../register.php");
    die();
}

echo $message;
