<?php
require_once(LIB_PATH.DS. 'Helpers'.DS.'initialize.php');
//Class That controls the initialization

class RoomControl{
    public $message;
    public $RoomNo;
    public $RoomType;
    public $RoomCharges;
    public $RoomStatus;
    //constructor that loads automatimally when the class in called
    public function __construct() {

        //checks if the form is posted
        if(isset($_POST['submit'])){
            $RoomNo   = $_POST['room_no'];
            $RoomType   = $_POST['roomtype'];
            $RoomCharges = $_POST['price'];
            $RoomStatus    = "vacant";
            //$verify_password = $_POST['v_password'];
            // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input
            if($this->validate_input($RoomNo, $RoomType, $RoomCharges, $RoomStatus) == true){
                //assigning the variable to the public vars
                $this->RoomNo       = $RoomNo;
                $this->RoomType     = $RoomType;
                $this->RoomCharges  = $RoomCharges;
                $this->RoomStatus   = $RoomStatus;
                $this->addRoom();

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
            $RoomNo        = $_POST['room_no'];
            $RoomType      = $_POST['roomtype'];
            $RoomCharges   = $_POST['price'];
            $RoomStatus    = $_POST['status'];
            //$verify_password = $_POST['v_password'];
            // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input

            //assigning the variable to the public vars
            $this->RoomNo         = $RoomNo;
            $this->RoomType       = $RoomType;
            $this->RoomCharges    = $RoomCharges;
            $this->RoomStatus     = $RoomStatus;
            $this->updateRoom($_GET['key']);

        }

    }

    //Attribute Validation function
    public function validate_input($RoomNo, $RoomType, $RoomCharges, $RoomStatus){

        //checks for empty fields
        if(empty($RoomNo) || empty($RoomType) || empty($RoomCharges) || empty($RoomStatus)){
            $message = "You left a blank field";
            $this->message = $message;
            return false;
        }

        /**checks for invalid characters
        if(!preg_match("/^[a-zA-Z0-9 ]*$/", $wardName)){
            $message = "Your Ward Name contains invalid characters";
            $this->message = $message;
            return false;
        }
        **/

        //validates wardname
        if($this->validate_room($RoomNo) == false){
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
    public function validate_room($RoomNo){
        $room = new Room();

        /**
        //checks for invalid email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message= "Invalid Email, Please verify the mail";
        $this->message = $message;
        return false;
        }
         * */
        //checks if the EMAIL EXIST
        if($room->check_room($RoomNo) == false){
            $message = "Room Number Exists, Register Another Room";
            $this->message = $message;
            return false;
        }
        return true;
    }

    //function that validates user email
    public function validate_email($email){
        $user = new User();


        //checks for invalid email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $message= "Invalid Email, Please verify the mail";
            $this->message = $message;
            return false;
        }

        //checks if the EMAIL EXIST
        if($user->check_user_email($email) == false){
            $message = "Ward Exists, Register Another Ward";
            $this->message = $message;
            return false;
        }
        return true;
    }


    //update ward
    public function updateRoom($RoomNo){
        $room = new Room();
        $room->RoomNo      =  $this->RoomNo;
        $room->RoomType    =  $this->RoomType;
        $room->RoomCharges =  $this->RoomCharges;
        $room->RoomStatus  =  $this->RoomStatus;
        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;

        if($room->update_by_RoomNo($RoomNo) == true ){
            $session = new Session();
            $_POST['msg'] = "Room Information Updated";
            $this->message = $_POST['msg'];
            redirect_to("room_list.php?msg=Room Information Updated");
        } else {
            $message = "Sorry! ): something went wrong with room update";
            $this->message = $message;
            return false;
        }
    }

    //Registration method
    public function addRoom(){

        $room = new Room();
        $room->RoomNo      =  $this->RoomNo;
        $room->RoomType    =  $this->RoomType;
        $room->RoomCharges =  $this->RoomCharges;
        $room->RoomStatus  =  $this->RoomStatus;
        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;

        if($room->create() == true ){
            $session = new Session();
            $_POST['msg'] = "New Room Registered";
            $this->message = $_POST['msg'];
            //$session->message("User Created, Login to Activate your session");
        } else {
            $message = "Sorry! ): something went wrong";
            $this->message = $message;
            return false;
        }
    }

    //ward deleting method
    public function deleteRoom(){
        //pic Must have an id
        if(isset($_GET['key'])){
            $rooms = new Room();
            if($rooms && $rooms->destroyRoom($_GET['key'])){
                $_GET['msg'] = "Ward Deleted Succesfully";
            } else {
                $_GET['msg'] = "Fail to Delete ward!";
            }

        }


    }


}

