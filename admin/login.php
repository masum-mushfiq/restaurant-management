<?php include '../css/config/constants.php'; ?>




<html>
    <head>
        <title>Login-Our Restaurant Website</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        

          <div class="login">
              <h1 class="text-center">Login</h1>
              <br><br>

              <?php
                  if (isset($_SESSION['login'])) {
                      echo $_SESSION['login'];
                      unset($_SESSION['login']);
                  }
                 if (isset($_SESSION['no-login-message'])) {
                     echo $_SESSION['no-login-message'];
                     unset($_SESSION['no-login-message']);
                 }
              ?>
              <br><br>
              <!-- Login from starts here -->
              <form action="" method="POST" class="text-center">
               Username: <br>
               <input type="text" name="username" placeholder="Enter Username"><br><br>
               Password: <br>
               <input type="password" name ="password" placeholder="Enter Password"><br><br>
                
               
               
               <input type="submit" name="submit" value="Login" class="btn-primary">
               <br><br>
              </form>
              <!-- Login from starts here -->

              <p class="text-center">Created By - <a href="https://www.linkedin.com/in/md-masum-mushfiq-9a82ab222/" target="_blank">Masum Mushfiq</a></p>

          </div>


    </body>
</html>

<?php

     //check the submit button clicked or not
     if (isset($_POST['submit'])) {
         //process for login
         //get the data from login form
         $username = $_POST['username'];
         $password = md5($_POST['password']);

         //check sql the username password exists or not
         $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

         //execute the querry
         $res = mysqli_query($conn, $sql);

         //count rows user exists or not
         $count = mysqli_num_rows($res);

         if ($count == 1) {
             // login success
             $_SESSION['login'] = "<div class='success'>Login Successful</div>";
             $_SESSION['user'] = $username; //check user is login or not
             //redirect to dashboard
             header('location:'.SITEURL.'admin/');
         } else {
             // login failed
             $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match</div>";
             //redirect to dashboard
             header('location:'.SITEURL.'admin/login.php');
         }
     }

?>