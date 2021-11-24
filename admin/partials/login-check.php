<?php

     // Authorization - Access control
     //check whether the user is logged or not
     if (!isset($_SESSION['user'])) {
         //user is not loggod in
         //redirect to login page with message
         $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login.</div>";
         //redirect to login page
         header('location:'.SITEURL.'admin/login.php');
     }
