<?php

include 'partials/menu.php'; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Ctagegory</h1>

        <br><br>

        <?php

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <br><br>
        <!-- Add Category Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Category Title">
                </td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input type="radio" name="featured" value="Yes"> Yes
                    <input type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                </td>
            </tr>

        </table>

        </form>
        <!-- Add Category Form Ends -->
        <?php
        //Check submit button clicked or not
        if (isset($_POST['submit'])) {
            // echo "Clicked";

            //Get the value from Category Form
            $title = $_POST['title'];

            //The Radio is ready to check ready or not
            if (isset($_POST['featured'])) {
                // Get the Value
                $featured = $_POST['featured'];
            } else {
                //Set the default value
                $featured = 'NO';
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = 'No';
            }

            //check the image is selected or not
            //print_r($_FILES['image']);

            // die();

            if (isset($_FILES['image']['name'])) {
                //upload the image
                $image_name = $_FILES['image']['name'];

                //upload the image only if image is availabe

             if($image_name!= "")
             {

    
                //auto rename our image
                //get the extentenion oue image (jpg,png,gif ect)
                $ext = end(explode('.',$image_name));
                //rename the page
                $image_name = "Food-category_".rand(000,999).'.'.$ext; // e.g.Food-Category_520.jpg
                

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = '../images/category/'.$image_name;
                $upload = move_uploaded_file($source_path, $destination_path);
                if ($upload == false) {
                    $_SESSION['upload'] = "<div class='error'>Faliled To Upload Image.</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                    die();
                }
            }
            } else {
                // Dont upload image
                $image_name = '';
            }

            //Create sql query to Insert category
            $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";

            // Check the query and save in database
            $res = mysqli_query($conn, $sql);

            // Check the query executed or not
            if ($res == true) {
                // Category Added
                $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
            } else {
                // Failed
                $_SESSION['add'] = "<div class='error'>Failed To Add Category.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        ?>

        <br><br>
    </div>
</div>


<?php

include 'partials/footer.php'; ?>