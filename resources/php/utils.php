<?php
/* 
Encryption for passwords and more.

@param: string $data `Data to encrypt.`
*/
function encrypt($data)
{
	/**
	 * One way encryption for little strings like name.
	 * @param string $data - Encryption key. Raw binary Required.
	 */
	$data = md5($data);
	$data = bin2hex($data);
	return $data;
}

function check($var)
{
	$var = trim($var);
	$var = stripslashes($var);
	$var = htmlspecialchars($var);
	return $var;
}

function check_image($message)
{
	if (substr($message, 0, 18) == "specialImageFileTo") {
		$message = "Sent an Image";
	}
	return $message;
}
