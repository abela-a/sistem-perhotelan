<?php
if (!session_id()) session_start();
header('Location:auth/login.php');
