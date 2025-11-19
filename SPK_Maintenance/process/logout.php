<?php
session_start();
session_unset();
session_destroy();
header('Location: /SPK_Maintenance/login.php');
exit;