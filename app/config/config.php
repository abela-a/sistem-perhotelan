<?php
if (!session_id()) session_start();

$db = mysqli_connect("localhost", "root", "", "db_hotel");

require_once '../app/functions/alert.php';
require_once '../app/functions/auto_number.php';
