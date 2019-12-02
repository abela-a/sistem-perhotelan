<?php
if (!session_id()) session_start();
header('Location:admin/dashboard.php');
