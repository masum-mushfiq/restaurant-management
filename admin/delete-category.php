<?php
    include('../css/config/constants.php');
   // echo "Delete Page";
   //check id and image_name is ser or not
   if(isset($_GET['id']) AND isset($_GET['image_name']))
   {
       //Get the value and delete
      // echo "Get Value And Delete";
      $id = $_GET['id'];
      $image_name = $_GET['image_name'];

      //Remove the physical image file
      if($image_name != "")
      {
          //Image is availalbe
         $path = "../images/category/".$image_name;
          //Remove the image
         $remove = unlike($path);
          //If failed to remove the image
          if($remove==false)
          {
              //set the session message
              $_SESSION['remove'] = "<div class='error'>Failed To Remove Category Image.</div>";
              //redierct to manage category
              header('location:'.SITEURL.'admin/manage-category.php');
              //stop the process
              die();
          }
      }

      //Delete data from data base
      $sql = "DELETE  FROM tbl_category WHERE id=$id";

      //Execute the query
      $res = mysqli_query($conn, $sql ,);

      //check the data delete or not
      if($res==true)
      {
          //set success message and redirect
          $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
          //redirect to manage category
          header('location:'.SITEURL.'admin/manage-category.php');
      }
      else{
          // set failed message and redirect
          $_SESSION['delete'] = "<div class='error'>Failed To Delete Category.</div>";
          //redirect to manage category
          header('location:'.SITEURL.'admin/manage-category.php');
      }

      // Redirect to manage Category page with Message
   }
   else
   {
       //redirect to manage category page
       header('location:'.SITEURL.'admin/manage-category.php');
   }
?>