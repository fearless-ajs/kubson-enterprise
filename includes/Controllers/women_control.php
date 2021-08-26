<?php
require_once(LIB_PATH.DS. 'Helpers'.DS.'initialize.php');
require_once(LIB_PATH.DS. 'Helpers'.DS.'women_image_processor.php');
//Class That controls the initialization

class WomenControl extends WomenImageProcessor {
    public $message;
    public $id;
    public $name;
    public $price;
    public $category;
    public $description;
    public $review;
    public $stock_date;
    public $full_view;
    public $front_view;
    public $back_view;
    public $side_view;
   //target paths
    public $full_view_path;
    public $front_view_path;
    public $back_view_path;
    public $side_view_path;
   
    
    //Pass in $_FILE(['uploaded_file']) as an argument
   //here the image is yo be processed
    
    //for that delete images form the databse
    public function destroy(){
        //First remove the database entry
        if($this->deleteStaff()){//if database entry is deleted successfully
            //Then remove the file
            $target_path = SITE_ROOT.DS.'public'.DS.$this->image_path();
            return unlink($target_path) ? TRUE : FALSE;
        } else {
            //database delete failed
            return FALSE;
        }
    }

    //image upload path
    public function image_path(){
        return $this->upload_dir.DS.$this->filename;
    }

    //constructor that loads automatimally when the class in called
    public function __construct() {

        //checks if the form is posted
        if(isset($_POST['submit'])){
            $itemName        = $_POST['name'];
            $price           = $_POST['price'];
            $category        = $_POST['category'];
            $description     = $_POST['description'];
            $review          = $_POST['review'];
            //$stock_date      = $_POST['date'];
            $full_view       = $_FILES['full_view_file'];
            $front_view      = $_FILES['front_view_file'];
            $back_view       = $_FILES['back_view_file'];
            $side_view       = $_FILES['side_view_file'];
            
            //Set object attributes to the image parameters

            //$verify_password = $_POST['v_password'];
            // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input
            if($this->validate_input($itemName, $price, $category, $description, $review,
                    $full_view, $front_view, $back_view, $side_view) == true){
                //assigning the variable to the public vars
              
                $this->name                 = $itemName;
                $this->price                = $price;
                $this->category             = $category;
                $this->description          = $description;
                $this->review               = $review;
               // $this->stock_date           = $stock_date;
                $this->full_view_path       = $this->full_view_target_path;
                $this->front_view_path      = $this->front_view_target_path;
                $this->back_view_path       = $this->back_view_target_path;
                $this->side_view_path       = $this->side_view_target_path;
             
                //Set object attributes to the image parameters
                $this->addStaff();

            }else{

            }
        }
        if(isset($_POST['update'])){
            $this->update();
        }

    }

    //update function
    public function update(){
        //checks if the update form is posted
        if(isset($_POST['update'])){
            $DoctorID            = $_POST['doctor_id'];
            $DoctorName          = $_POST['name'];
            $FatherName          = $_POST['f_name'];
            $Address             = $_POST['address'];
            $ContactNo           = $_POST['number'];
            $Email               = $_POST['email'];
            $Qualifications      = $_POST['qual'];
            $Specialization      = $_POST['spec'];
            $Gender              = $_POST['gender'];
            $BloodGroup          = $_POST['blood_group'];
            $DateOfJoining       = $_POST['date_joined'];
            //$verify_password = $_POST['v_password'];
            // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input

            //assigning the variable to the public vars
            $this->DoctorID             = $DoctorID;
            $this->DoctorName           = $DoctorName;
            $this->FatherName           = $FatherName;
            $this->Address              = $Address;
            $this->ContactNo            = $ContactNo;
            $this->Email                = $Email;
            $this->Qualifications       = $Qualifications;
            $this->Specialization       = $Specialization;
            $this->Gender               = $Gender;
            $this->BloodGroup           = $BloodGroup;
            $this->DateOfJoining        = $DateOfJoining;
            $this->updateStaff($_GET['key']);

        }

    }

    //Attribute Validation function
    public function validate_input($itemName, $price, $category, $description, $review,
                    $full_view, $front_view, $back_view, $side_view){
        //checks for empty fields
        if(empty($itemName) || empty($price) || empty($category) || empty($description) || empty($review)
            || empty($full_view) || empty($front_view) || empty($back_view) || empty($side_view)){
            $message = "You left a blank field";
            $this->message = $message;
            return false;
        }
        //checks for invalid characters
        if(!preg_match("/^[a-zA-Z0-9 ]*$/", $itemName)){
            $message = "Your Entries contains invalid characters";
            $this->message = $message;
            return false;
        }

        //attch file first
        if($this->attach_file($full_view, $front_view, $back_view, $side_view) == false){
            return true;
        }
        
        //then image processor
        if($this->imageProcessor() == false){
            return false;
        }
        return true;
        /**
        //check if the password matches and checkbox is checked
        return $this->password_and_checkbox($password, $verify_password, $checkbox) == true ? true : false;
         **/
    }
   

    //password verification and checkbox
    public function password_and_checkbox($password, $verify_password, $checkbox){
        //check if the password matches
        if($password != $verify_password){
            $message = "Password doesn't match";
            $this->message = $message;
            return false;
        }
        //check if the checkbox is.. checked
        if(!empty($checkbox) && $checkbox == 'yes'){
            return true;
        }else{
            $message = "You need to agree to the terms of use";
            $this->message = $message;
            return false;
        }
    }

    //function that validates user email
    public function validate_staff($ID){
        $user = new Specialist();

        /**
        //checks for invalid email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message= "Invalid Email, Please verify the mail";
        $this->message = $message;
        return false;
        }
         * */
        //checks if the EMAIL EXIST
        if($user->check_staff($ID) == false){
            $message = "ID taken, Use Another ID";
            $this->message = $message;
            return false;
        }
        return true;
    }

    //function that validates user email
    public function validate_email($Email){
        $user = new Specialist();


        //checks for invalid email
        if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
            $message= "Invalid Email, Please verify the mail";
            $this->message = $message;
            return false;
        }

        //checks if the EMAIL EXIST
        if($user->check_user_email($Email) == false){
            $message = "Email Exists, Register Another Email";
            $this->message = $message;
            return false;
        }
        return true;
    }

    //update ward
    public function updateStaff($ID){

        $staff = new Specialist();
        $staff->DoctorID        =  $this->DoctorID;
        $staff->DoctorName      =  $this->DoctorName;
        $staff->FatherName       =  $this->FatherName;
        $staff->Address         =  $this->Address;
        $staff->ContactNo       =  $this->ContactNo;
        $staff->Email           =  $this->Email;
        $staff->Qualifications  =  $this->Qualifications;
        $staff->Specialization  =  $this->Specialization;
        $staff->Gender          =  $this->Gender;
        $staff->BloodGroup      =  $this->BloodGroup;
        $staff->DateOfJoining   =  $this->DateOfJoining;
        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;

        if($staff->update_by_doctor_ID($ID) == true ){
            $session = new Session();
            $_POST['msg'] = "Specialist Information Updated";
            $this->message = $_POST['msg'];
            redirect_to("specialist_list.php?msg=Specialist Information Updated");
        } else {
            $message = "Sorry! ): something went wrong";
            $this->message = $message;
            return false;
        }
    }

    //Registration method
    public function addStaff(){

        $item = new Women();
        $item->name           =  $this->name;
        $item->price          =  $this->price;
        $item->category       =  $this->category;
        $item->description    =  $this->description;
        $item->review         =  $this->review;
        $item->full_view      =  $this->full_view_path;
        $item->front_view     =  $this->front_view_path;
        $item->back_view      =  $this->back_view_path;
        $item->side_view      =  $this->side_view_path;
        $item->stock_date     = strftime("%Y-%m-%d %H:%M:%S", time());
       //image_path(), the function that sets the image directory.
        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;



        if($item->create() == true ){
            unset($this->temp_path);
            $session = new Session();
            $_POST['msg'] = "New Product Published";
            $this->message = $_POST['msg'];
            //$session->message("User Created, Login to Activate your session");
        } else {
            $message = "Sorry! ): something went wrong";
            $this->message = $message;
            return false;
        }
    }

    //ward deleting method
    public function deleteItem(){
        //pic Must have an id
        if(isset($_GET['del_key'])){
            $items = new Women();
            if($items && $items->destroyItem($_GET['del_key'])){
                $_GET['msg'] = "Product Deleted Succesfully";
                return true;
            } else {
                $_GET['msg'] = "Fail to Delete Product!";
                return false;
            }

        }


    }


}



