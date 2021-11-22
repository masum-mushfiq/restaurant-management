<?php include 'partials/menu.php'; ?>

<div class="main-content">
    <div class="weapper">
        <h1>Change Password</h1>
        <br><br>
        

        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        ?>
        <form action="" method="POST">
             
        <table class="tbl-30">
            <tr>
                <td>Current Password:</td>
                <td>
                    <input type="password" name="current_password" placeholder="Current Password">
                </td>
            </tr>

            <tr>
                <td>New Password:</td>
                <td>
                    <input type="password" name="new_password" placeholder="New Password">
                </td>
            </tr>

            <tr>
                <td>Confirm Password:</td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                </td>

            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>
            </tr>

        </table>



        </form>
    </div>

</div>

<?php
      //check the submit button clicked or not
      if (isset($_POST['submit'])) {
          //echo 'Clicked';

          // get the data from Form
          $id = $_POST['id'];
          $current_password = md5($_POST['current_password']);
          //$row_password = md5($_POST['new_password']);
          $confirm_password = md5($_POST['confirm_password']);
          $new_password = md5($_POST['new_password']);
          //check id password exixst or not
          $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

          //execute the querry
          $res = mysqli_query($conn, $sql);

          if ($res == true) {
              //check data is availabe or not
              $count = mysqli_num_rows($res);

              if ($count == 1) {
                  //user exits password can be changed
                  // echo 'User Found';
                  //whether the new pass and confirm pass match or not
                  if ($new_password == $confirm_password) {
                      //update the password
                      // echo 'Password Match';
                      $sql2 = "UPDATE tbl_admin SET
                            password='$new_password'
                            WHERE id=$id
                            ";

                      //Execute the querry
                      $res2 = mysqli_query($conn, $sql2);

                      //check the query executed or not
                      if ($res2 == true) {
                          //display success message
                          $_SESSION['change-pwd'] = "<div class ='success'>Password Changed Successfully. </div>";
                          //redirect the user
                          header('location:'.SITEURL.'admin/manage-admin.php');
                      } else {
                          //display error message
                          $_SESSION['change-pwd'] = "<div class ='error'>Failed To Changed Password. </div>";
                          //redirect the user
                          header('location:'.SITEURL.'admin/manage-admin.php');
                      }
                  } else {
                      //redirect to manage admin page
                      $_SESSION['pwd-not-match'] = "<div class ='error'>Password Did Not Match. </div>";
                      //redirect the user
                      header('location:'.SITEURL.'admin/manage-admin.php');
                  }
              } else {
                  //user does not exist
                  $_SESSION['user-not-found'] = "<div class ='error'>User Not Found. </div>";
                  //redirect the user
                  header('location:'.SITEURL.'admin/manage-admin.php');
              }
          }

          //check the new password and confirm password match or not

          //change password if all above true
      }
?>



<?php include 'partials/footer.php'; ?>