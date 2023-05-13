<?php
session_start();
session_unset();
session_destroy();
header("Location: index.php");
//ending the sessions used in the page

?>