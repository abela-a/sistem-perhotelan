<?php
if (!session_id()) session_start();
header('Location:app/views/admin/dashboard.php');
