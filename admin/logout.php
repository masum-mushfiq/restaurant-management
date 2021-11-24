<?php

     //include constants.php for siteurl
     include '../css/config/constants.php';
    // destroy the session
    session_destroy(); //unset $_SESSION['user']

    //redirect to login page
    header('location:'.SITEURL.'admin/login.php');
