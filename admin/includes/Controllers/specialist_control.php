<?php
require_once(LIB_PATH.DS. 'Helpers'.DS.'initialize.php');
//Class That controls the initialization

class SpecialistControl{
    public $message;
    public $DoctorID;
    public $DoctorName;
    public $FatherName;
    public $Address;
    public $ContactNo;
    public $Email;
    public $Qualifications;
    public $Specialization;
    public $Gender;
    public $BloodGroup;
    public $DateOfJoining;
    public $id;
    public $filename;
    public $type;
    public $size;
    private $temp_path;
    protected $upload_dir = "uploads/images/specialists";
    public  $errors = array();

    protected $uploads_errors = array(
        //http://www.php.net/manual/en/features.file-upload.errors.php
        UPLOAD_ERR_OK         => "No error.",
        UPLOAD_ERR_INI_SIZE   => "Larger than upload max_file_size.",
        UPLOAD_ERR_FORM_SIZE  => "Larger than max_file_size.",
        UPLOAD_ERR_PARTIAL    => "partial UPLOAD.",
        UPLOAD_ERR_NO_FILE    => "No file.",
        UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
        UPLOAD_ERR_CANT_WRITE => "cant write to disk.",
        UPLOAD_ERR_EXTENSION  => "file upload stopped by extension."
    );

    //Pass in $_FILE(['uploaded_file']) as an argument
    public function attach_file($file){
        //Perform error checking on the form parameters
        if(!$file || empty($file) || !is_array($file)){
            //error: nothing uploaded or wrong argument usage
            $this->errors[] = "No file was uploaded.";
            $message = "No file was uploaded";
            $this->message = $message;
            return FALSE;
        }elseif ($file['error'] != 0) {
            //error report what php  says went wrong
            $this->errors[] = $this->uploads_errors[$file['error']];
            $message = $this->uploads_errors[$file['error']];;
            $this->message = $message;
            return FALSE;
        }else{
            //Set object attributes to the form parameters
            $this->temp_path  = $file['tmp_name'];
            $this->filename   = basename($file['name']);
            $this->type       = $file['type'];
            $this->size       = $file['size'];
            return TRUE;
            //and make it ready to be saved in the database
        }

    }

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

    //function for displaying image size properly
    public function size_as_text(){
        if($this->size < 1024){
            return "{$this->size}";
        }elseif ($this->size < 1048576) {
            $size_kb = round($this->size/1024);
            return "{$size_kb} KB";
        } else {
            $size_mb = round($this->size/10485);
            return "{$size_mb} MB";
        }
    }

    //constructor that loads automatimally when the class in called
    public function __construct() {

        //checks if the form is posted
        if(isset($_POST['submit'])){
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
            $file                = $_POST['file_upload'];
            //Set object attributes to the image parameters

            //$verify_password = $_POST['v_password'];
            // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input
            if($this->validate_input($DoctorID, $DoctorName, $FatherName, $Address, $ContactNo, $Email,
                    $Qualifications, $Specialization, $Gender, $BloodGroup, $DateOfJoining, $file) == true){
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
    public function validate_input($DoctorID, $DoctorName, $FatherName, $Address, $ContactNo, $Email,
                                   $Qualifications, $Specialization, $Gender, $BloodGroup, $DateOfJoining, $file){
        //checks for empty fields
        if(empty($DoctorID) || empty($DoctorName) || empty($FatherName) || empty($Address) || empty($ContactNo) || empty($Email)
            || empty($Qualifications) || empty($Specialization) || empty($Gender) || empty($BloodGroup) || empty($DateOfJoining)|| empty($file)){
            $message = "You left a blank field";
            $this->message = $message;
            return false;
        }
        //checks for invalid characters
        if(!preg_match("/^[a-zA-Z0-9 ]*$/", $DoctorName)){
            $message = "Your Ward Name contains invalid characters";
            $this->message = $message;
            return false;
        }

        //validates email
        if($this->validate_email($Email) == false){
            return false;
        }

        //validates staff ID
        if($this->validate_staff($DoctorID) == false){
            return false;
        }

        //validate image upload
        if($this->attach_file($file) == FALSE){
            return FALSE;
        }

        //validate image upload
        if($this->imageProcessor($file) == FALSE){
            return FALSE;
        }
        return true;
        /**
        //check if the password matches and checkbox is checked
        return $this->password_and_checkbox($password, $verify_password, $checkbox) == true ? true : false;
         **/
    }
    //image processing function
    public function imageProcessor(){

        //Can't save if there are pre-existing errors
        if(!empty($this->errors)){ return FALSE; }

        //Cant save without filename
        if(empty($this->filename) || empty($this->temp_path)){
            $this->errors[] = "The file location was not available";
            $message = "The file location was not available";
            $this->message = $message;
            return FALSE;
        }

        //Determine the target_path
        $target_path = SITE_ROOT .DS. 'public' .DS. $this->upload_dir .DS. $this->filename;

        //Make sure a file doesn't already exist in the target location
        if(file_exists($target_path)) {
            $this->errors[] = "The file {$this->filename} already exist.";
            $message = "The file {$this->filename} already exist.";
            $this->message = $message;
            return FALSE;
        }
        //Attempt to move the file
        if(move_uploaded_file($this->temp_path, $target_path)) {
            //Success
            return TRUE;
        }else{
            //File was not moved
            $this->errors[] = "The file upload failed, possibly due to "
                . "incorect permissions on the upload folder";
            $message = "The file upload failed, possibly due to "
                . "incorect permissions on the upload folder";
            $this->message = $message;
            return FALSE;
        }
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

        $staff = new Specialist();
        $staff->DoctorID        =  $this->DoctorID;
        $staff->DoctorName      =  $this->DoctorName;
        $staff->FatherName      =  $this->FatherName;
        $staff->Address         =  $this->Address;
        $staff->ContactNo       =  $this->ContactNo;
        $staff->Email           =  $this->Email;
        $staff->Qualifications  =  $this->Qualifications;
        $staff->Specialization  =  $this->Specialization;
        $staff->Gender          =  $this->Gender;
        $staff->BloodGroup      =  $this->BloodGroup;
        $staff->DateOfJoining   =  $this->DateOfJoining;
        $staff->image_path      = $this->image_path(); //image_path(), the function that sets the image directory.
        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;



        if($staff->create() == true ){
            unset($this->temp_path);
            $session = new Session();
            $_POST['msg'] = "New Specialist Registered";
            $this->message = $_POST['msg'];
            //$session->message("User Created, Login to Activate your session");
        } else {
            $message = "Sorry! ): something went wrong";
            $this->message = $message;
            return false;
        }
    }

    //ward deleting method
    public function deleteStaff(){
        //pic Must have an id
        if(isset($_GET['key'])){
            $staffs = new Specialist();
            if($staffs && $staffs->destroyStaff($_GET['key'])){
                $_GET['msg'] = "Doctor Deleted Succesfully";
                return true;
            } else {
                $_GET['msg'] = "Fail to Delete Doctor!";
                return false;
            }

        }


    }


}



