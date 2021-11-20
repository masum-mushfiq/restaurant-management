<?php
       //include constant.php file here
       include '../css/config/constants.php';

      // get the id of admin
       $id = $_GET['id'];

      // create sql querry to delete admin
      $sql = "DELETE FROM tbl_admin WHERE id = $id";

      //Execute the querry
      $res = mysqli_query($conn, $sql);

      //check whether the querry executed successfully or not
      if ($res == true) {
          //querry executed successfully and admin deleted
          //echo 'Admin Deleted';
          //create sessiion variable to display message
          $_SESSION['delete'] = '<div class="success">Admin Deleted Successfully.</div>';
          // redirectto manage admin pagehe
          header('location:'.SITEURL.'admin/manage-admin.php');
      } else {
          //failed to delete admin
          //echo 'Failed To Delete Admin';
          $_SESSION['delete'] = '<div class="error">Failed to Delete Admin. Try Again Later.</div>';
          header('location:'.SITEURL.'admin/manage-admin.php');
      }

      // redirect to manage admin page with message (success/error)

?>      
