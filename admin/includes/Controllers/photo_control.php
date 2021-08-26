<?php
require_once(LIB_PATH.DS. 'Helpers'.DS.'initialize.php');
class PhotoControl{
    
   //Constructor that makes sure we get an id  
   public function __construct() {
       //code that generally runs automatically stays within this block
       
   }
   
   //function that if an id is posted
   public function verify_image_id(){
       //checks if the image id is et
        if(empty($_GET['id'])){
        $session = new Session();
        $session->message("No photograph was provided");
        redirect_to('index.php');
        }
        
   }
   
  //Methods that finds the image with the given id
   public function find_image(){
       //find the photo with the provided id
        $photo = Photograph::find_by_id($_GET['id']);
        if(!$photo){
           $session = new Session();
           $session->message("the photo could not be located");
           redirect_to('index.php');
        }
        return $photo;
     }
     
   //photo that removes images
   public function delete_photo(){
       //it's only going to perform the delete if the photo_id is set
           if(isset($_GET['del_id'])){
           $photo = Photograph::find_by_id($_GET['del_id']);
         if($photo && $photo->destroy()){
             $session = new Session();
             $session->message("The photo {$photo->filename} was Deleted");
             redirect_to('list_photos.php');
         } else {
             $session->message("The photo could not be deleted");

                }
            }
    }
    
   //functio that controls insertion of images into the database
   public function insert_image(){
       //photo processing script
        $max_file_size = 1048576; //expressed in bytes
                          // 10240 = 10kb
                          // 102400 = 100kb
                          // 1048576 = 1MB
                          // 10485760 = 10MB
  //************************************************//    
        //checks if the form is posted
        if(isset($_POST['submit'])){
            $photo = new Photograph();
            $photo->caption = $_POST['caption'];
            $photo->attach_file($_FILES['file_upload']); //Would have used if statement to check for errors but save() has already done that
            if($photo->save()){
                //Success
                $session = new Session();
                $session->message("Photograph uploaded successfuly.");
                redirect_to('list_photos.php');
            } else {
                //Failure
                $message = join("<br>", $photo->errors);
            }
        }
 }


 
}