<?php
session_start();
include_once "connect.php";
include_once "utils.php";
$Unique_Id = $_SESSION['Unique_Id'];
if (isset($_SESSION['Unique_Id'])) {
    $Unique_Id = $_SESSION['Unique_Id'];

    $sql1 = mysqli_query($conn, "SELECT * FROM `lads` WHERE `Unique Id` = '$Unique_Id'");
    $row1 = mysqli_fetch_assoc($sql1);

    // Need to change
    if (mysqli_num_rows($sql1) < 1) {
        header('location: ../../index.php');
        die();
    }
}

if (empty($Unique_Id)) {
    header('location: ../../register.php');
    die();
}


$sql2 = mysqli_query($conn, "SELECT * FROM `lads` WHERE NOT `Unique Id` = '$Unique_Id'"); // All users accept me. I won't message myself
$my_id = $row1['User Id'];
if (mysqli_num_rows($sql2) > 0) {
    while ($row2 = mysqli_fetch_assoc($sql2)) {
        $active = "";

        $he_id = $row2['User Id'];
        if ($row2['User Id'] != 'community') {
            $sql3 = mysqli_query($conn, "SELECT * FROM `messages` WHERE (`sender_id` = '$my_id' AND `receiver_id` = '$he_id') OR (`sender_id` = '$he_id' AND `receiver_id` = '$my_id') ORDER BY `Id` DESC LIMIT 1");
        } else {
            $sql3 = mysqli_query($conn, "SELECT * FROM `community` WHERE 1 ORDER by `Id` DESC LIMIT 1");
        }

        if (mysqli_num_rows($sql3) > 0) {
            $row3 = mysqli_fetch_assoc($sql3);
            $result = $row3['Message'];

            if (strlen($result) > 18) {
                $result = check_image($result);
                $result = substr($result, 0, 18) . '...';
                if ($my_id == $row3['sender_id']) {
                    $result = 'You: ' . $result;
                } else {
                    if ($row2['User Id'] != 'community') {
                        $he_name = $row2['Full Name'];
                        $he_name_explode = explode(" ", $he_name);
                        $he_name = $he_name_explode[0];
                        $result = $he_name . ': ' . $result;
                    } else {
                        $he_id = $row3['sender_id'];
                        $sql4 = mysqli_query($conn, "SELECT * FROM `lads` WHERE `User Id` = '$he_id'");
                        $row4 = mysqli_fetch_assoc($sql4);
                        $he_name = $row4['Full Name'];
                        $he_name_explode = explode(" ", $he_name);
                        $he_name = $he_name_explode[0];
                        $result = $he_name . ': ' . $result;
                    }
                }
            } else {
                if ($my_id == $row3['sender_id']) {
                    $result = 'You: ' . $result;
                } else {
                    if ($row2['User Id'] != 'community') {
                        $he_name = $row2['Full Name'];
                        $he_name_explode = explode(" ", $he_name);
                        $he_name = $he_name_explode[0];
                        $result = $he_name . ': ' . $result;
                    } else {
                        $he_id = $row3['sender_id'];
                        $sql4 = mysqli_query($conn, "SELECT * FROM `lads` WHERE `User Id` = '$he_id'");
                        $row4 = mysqli_fetch_assoc($sql4);
                        $he_name = $row4['Full Name'];
                        $he_name_explode = explode(" ", $he_name);
                        $he_name = $he_name_explode[0];
                        $result = $he_name . ': ' . $result;
                    }
                }
            }
        } else {
            $result = "No Messages.";
        }

        if ($row2['Active'] > time()) {
            $active = "online";
        }

        echo "
        <a href='members.php?receiver-id=" . $row2['User Id'] . "' class='shadow'>
            <img src='resources/img/" . $row2['Image'] . "' alt='Others Profile' class='" . $row2['Gender'] . "' />
            <div class='name'>
                <span>" . $row2['Full Name'] . "</span>
                <span>" . $result . "</span>
            </div>
            <div class='active " . $active . "'></div>
        </a>
        ";
    }
}
