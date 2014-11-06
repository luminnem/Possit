<?php

session_start();
if (strtolower($_POST['answer']) == $_SESSION['captcha'])
	echo "1";
else {
	echo "Incorrect captcha!";
	unset($_SESSION['captcha']);
}
