<?php include 'partials/menu.php'; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
           if (isset($_SESSION['add'])) {
               echo $_SESSION['add'];
               unset($_SESSION['add']);
           }
        ?>

        <form action="" method="POST">

             <table class="tbl-30">
                 <tr>
                     <td>Full Name:</td>
                     <td>
                         <input type="text" name="full_name" placeholder="Enter Your Name">
                     </td>
                 </tr>

                 <tr>
                     <td>Username:</td>
                     <td>
                         <input type="text" name="username" placeholder="Your Username">
                     </td>
                 </tr>

                 <tr>
                     <td>Password:</td>
                     <td>
                         <input type="password" name="password" placeholder="Your Password">
                     </td>
                 </tr>

                 <tr>
                     <td colspan="2">
                         <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                     </td>
                 </tr>
             </table>

        </form>

    </div>

</div>

<?php include 'partials/footer.php'; ?>

<?php

    //process the value from Form and Save it in Database
    //check whether the button is clicked or not

    if (isset($_POST['submit'])) {
        //Button clicked
        //echo "Button Clicked";

        //Get the Data From form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption with md5

        //sql Querry to Save The data into database
        $sql = "INSERT INTO tbl_admin SET
              full_name ='$full_name',
              username ='$username',
              password ='$password'
         ";

        // Execute Querry and Save Data in Database
         $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error()); //Database Connection
         $db_select = mysqli_select_db($conn, 'restaurant-mangement') or die(mysqli_error()); // Selecting Database

         $res = mysqli_query($conn, $sql) or die(mysqli_error());

        if ($res == true) {
            //echo 'Data Inserted';
            //Creeate a Session Variable to Display message;
            $_SESSION['add'] = '<div class="success">Admin Added Successfully.</div>';
            //Redirect Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        } else {
            // echo 'Failed To Insert';
            //Creeate a Session Variable to Display message;
            $_SESSION['add'] = '<div class="error">Failed to Added Admin. Try Again Later.</div>';
            //Redirect Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>
