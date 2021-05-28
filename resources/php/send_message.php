<?php
session_start();
if (isset($_SESSION['Unique_Id'])) {
    include_once "connect.php";
    include_once "utils.php";
    if ($conn) {
        $sender_id = mysqli_real_escape_string($conn, check($_POST['sender-id'])); // User id
        $receiver_id = mysqli_real_escape_string($conn, check($_POST['receiver-id']));
        $send_message = mysqli_real_escape_string($conn, check($_POST['send-message']));

        if (!empty($sender_id) && !empty($receiver_id)) {
            $sql_sender = mysqli_query($conn, "SELECT * FROM `lads` WHERE `User Id` = '$sender_id'");
            $sql_receiver = mysqli_query($conn, "SELECT * FROM `lads` WHERE `User Id` = '$receiver_id'");
            if ((mysqli_num_rows($sql_receiver) > 0) && (mysqli_num_rows($sql_sender) > 0)) {
                if (!empty($send_message)) {
                    $row_receiver = mysqli_fetch_assoc($sql_receiver);
                    date_default_timezone_set("Asia/Dhaka");
                    $time = date("F j, Y, h:i a");
                    if ($receiver_id == "community") {
                        $sql1 = mysqli_query($conn, "INSERT INTO `community`(`Id`, `sender_id`, `receiver_id`, `Message`, `Time`) VALUES ('','$sender_id', '$receiver_id', '$send_message', '$time')");
                    } else {
                        $sql1 = mysqli_query($conn, "INSERT INTO `messages`(`Id`, `sender_id`, `receiver_id`, `Message`, `Time`) VALUES ('','$sender_id', '$receiver_id', '$send_message', '$time')");
                    }
                } else if (isset($_FILES['send_image'])) {
                    $img_name = $_FILES['send_image']['name'];
                    $img_tmp_name = $_FILES['send_image']['tmp_name'];
                    $img_explode = explode('.', $img_name);
                    $img_extension = end($img_explode);
                    $extensions = ['jpg', 'png', 'gif', 'webp', 'jpeg'];

                    if (in_array($img_extension, $extensions)) {
                        $row_receiver = mysqli_fetch_assoc($sql_receiver);
                        date_default_timezone_set("Asia/Dhaka");
                        $time = date("F j, Y, h:i a");
                        $time2 = time() * 2;
                        $new_image_name = $time2 . $img_name;
                        $send_message = "specialImageFileToBeSaved.:" . $new_image_name;
                        if ($receiver_id == "community") {
                            $sql1 = mysqli_query($conn, "INSERT INTO `community`(`Id`, `sender_id`, `receiver_id`, `Message`, `Time`) VALUES ('','$sender_id', '$receiver_id', '$send_message', '$time')");
                        } else {
                            $sql1 = mysqli_query($conn, "INSERT INTO `messages`(`Id`, `sender_id`, `receiver_id`, `Message`, `Time`) VALUES ('','$sender_id', '$receiver_id', '$send_message', '$time')");
                        }
                        move_uploaded_file($img_tmp_name, "../img/" . $new_image_name);
                    } else {
                        echo "<div class='user_message'>Please Select a valid image with 'jpg', 'png', 'gif', 'webp', 'jpeg' extensions. Please refresh your browser</div>";
                    }
                }
            } else {
                $message = "<div class='user_message'>Your requested user currently unreachable. Please refresh your browser</div>";
            }
        } else {
            echo "Select a friend and start chatting.";
        }
    } else {
        $message = "<div class='user_message'>Disconnected From Database. Try To Reconnected And Join Again.</div>";
    }
} else {
    header("location: ../../register.php");
    die();
}
