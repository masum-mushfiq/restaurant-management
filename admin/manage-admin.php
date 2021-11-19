<?php include 'partials/menu.php'; ?>

        <!-- Main Content Section Starts Here -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>

                <br /><br />

                <?php
                   if (isset($_SESSION['add'])) {
                       echo $_SESSION['add']; //Displaying Session Message
                       unset($_SESSION['add']); //Removing Session Message
                   }
                ?>
                <br><br><br>

                <!-- Button to add admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>

                <br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>Serial No.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>


                    <?php
                       //Query to Get all admin
                       $sql = 'SELECT * FROM tbl_admin';
                       //Execute theQuerry
                       $res = mysqli_query($conn, $sql);
                       //check whether the querry is executed of not
                       if ($res == true) {
                           //count rows
                           $rows = mysqli_num_rows($res); // Function to get all the rows
                           $sn = 1; //Create a varialbe assign the value
                           //check the num of rows
                           if ($rows > 0) {
                               //we have database
                               while ($rows = mysqli_fetch_assoc($res)) {
                                   //using while loop to get all data
                                   //And while loopwill runas long as we have data in data base
                                   //Get individual data
                                   $id = $rows['id'];
                                   $full_name = $rows['full_name'];
                                   $username = $rows['username'];

                                   //display the value?>

                   <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $username; ?></td>
                        <td>
                            <a href="#" class="btn-secondary">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                        
                    </tr>

                    <?php
                               }
                           } else {
                               //we do not have data base
                           }
                       }

                    ?>

                   
                </table>

                

                <div class="clearfix"></div>
            </div>
            
        </div>
        <!-- Main Content Section Ends Here -->

<?php include 'partials/footer.php'; ?>        
