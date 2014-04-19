<?php
session_start();
$_SESSION['usegen'] = TRUE;
header("Refresh: 0;url=index.php");