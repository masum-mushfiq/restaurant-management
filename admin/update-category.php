<?php

    include 'partials/menu.php';

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>


        <?php

        //check the id isset or not
        if(isset($_GET['id']))
        {
            //Get the id
           // echo "Getting the Data";
           $id = $_GET['id'];
           //create sql query to get all others details
           $sql = "SELECT * FROM tbl_category WHERE id=$id";

           //Execute the query
           $res = mysqli_query($conn, $sql);

           //count the rows to check the id is valid or not
           $count = mysqli_num_rows($res);

           if($count==1)
           {
               //get the data
               $row = mysqli_fetch_assoc($res);
               $title = $row['title'];
               $current_image = $row['image_name'];
               $featured = $row['featured'];
               $active = $row['active'];
           }
           else
           {
               //redirect to manage category
               $_SESSION['no-category-found'] = "<div class='error'>Category Not Found.</div>";
               header('location:'.SITEURL.'admin/manage-category.php');
           }
        }
        else
        {
            //redirect to manage category
            header('location'.SITEURL.'admin/manage-category.php');
        }
        
        
        ?>
     <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title;?>">
                </td>
            </tr>

            <tr>
                <td>Current Image</td>
                <td>
                    <?php 
                         if($current_image != "")
                         {
                             //display the image
                             ?>
                             <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="150px" >
                             <?php
                         }
                         else
                         {
                             //display message
                             echo "<div class='error'>Image Not Added</div>";
                         }
                    ?>
                </td>
            </tr>

            <tr>
                <td>New image</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Featured</td>
                <td>
                    <input <?php if($featured=="Yes") {echo "checked";}?> type="radio" name="featured" value="Yes"> Yes

                    <input <?php if($featured=="No") {echo "checked";}?> type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active</td>
                <td>
                  <input <?php if($active=="Yes") {echo "checked";}?> type="radio" name="active" value="Yes"> Yes

                  <input <?php if($active=="No") {echo "checked";}?> type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                   <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>

        </table>

     </form>

     <?php
     
        if(isset($_POST['submit']))
        {
            //echo "clicked";
            //get all the values from oue form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST ['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //updating new image
            //check the image is selected or not
            if(isset($_FILES['image']['name']))
            {
                //get the image details
                $image_name = $_FILES['image']['name'];

                //check image name availablr or not
                if($image_name != "")
                {
                    //Image available
                    //upload the new image

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
                    header('location:'.SITEURL.'admin/manage-category.php');
                    die();
                }

                    //remove the current image
                    if($current_image !="")
                    {
                        $remove_path = "../images/category/".$current_image;

                        $remove = unlike($remove_path);
    
                        //check the image is remove or not
                        if($remove==false)
                        {
                            //Failed to removee image
                            $_SESSION['failed-remove'] = "<div class='error'>Failed To Remove Current Image.</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();
                        }
                    }
                    
                }
                else
                {
                    $image_name = $current_image;
                }

            }
            else
            {
                $image_name = $current_image;
            }

            //update the database 
            $sql2 = "UPDATE tbl_category SET
                title = '$title',
                image_name = '$title',
                featured = '$featured',
                active = '$active'
                WHERE id = $id

            
            ";

            //exacute the query
            $res2 = mysqli_query($conn, $sql2);

            //redirect to manage category
            //check query executed or nor
            if($res2==true)
            {
                //category added
                $_SESSION['update'] = "<div class='success'>Category Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                //failed to update category
                $_SESSION['update'] = "<div class='error'>Failed To Update Category.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }

            
        } 
     
     ?>
    </div>
</div>

<?php

    include 'partials/footer.php';

?>