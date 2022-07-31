<!--ID : 2020052_BSE -->
<!--Name : WAN HAO XIN   -->
<!--Topic : Final Year Project Codes-->





<?php
session_start();

// remove all session variables
session_unset();

// destroy the session 
session_destroy();

header("Location:index.php?msg=logout");
