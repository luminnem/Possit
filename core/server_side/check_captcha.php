<?php

session_start();
if (strtolower($_POST['captcha']) == $_SESSION['captcha'])
	echo '1';
else
	echo '2';

unset($_SESSION['captcha']);