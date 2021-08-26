<?php
require_once(LIB_PATH.DS. 'Helpers'.DS.'initialize.php');
//Class That controls the initialization 

class CartControl{
    public $message; 
    public $productId;
    public $productName;
    public $product_size;
    //public $quantity;
    public $productPrice;
    public $product_image;
    //constructor that loads automatimally when the class in called
    public function __construct() {
   
        //checks if the form is posted
        if(isset($_GET['cartId'])){
            $productId = $_GET['cartId'];
            $productName    = $_GET['cartName'];
            $productSize    = $_GET['cartSize'];
            $productPrice    = $_GET['cartPrice'];
            $productImage = $_GET['cartImage'];
            
            
            
            //validating user input
            if($this->validate_input($productId, $productName, $productSize, $productPrice, $productImage) == true){
             //assigning the variable to the public vars
            $this->productId = $productId;
            $this->productName    = $productName;
            $this->product_size   = $productSize;
            $this->productPrice    = $productPrice;
            $this->product_image = $productImage;
            $this->addCart();
             
           }else{

           }
          
       }
        if(isset($_POST['reset'])){
            $this->resetPassword();
        }
        
        if(isset($_POST['update'])){
            $this->update();
        }
   }

   
   
   //update function
    public function update(){
        //checks if the update form is posted
        if(isset($_POST['update'])){
    
            $fullname = $_POST['name'];
            $email    = $_POST['email'];
            $password = $_POST['password'];
        
            //$verify_password = $_POST['v_password'];
            // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input

            //assigning the variable to the public vars
            $this->fullname = $fullname;
            $this->email    = $email;
            $this->password = $password;
            $this->updateUser($_GET['key']);

        }

    }
    
     //update ward
    public function updateUser($ID){

        $staff = new User();
        $staff->id              =  $ID;
        $staff->fullname        =  $this->fullname;
        $staff->email           =  $this->email;
        $staff->password        =  $this->password;
 
        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;

        if($staff->update_by_id($ID) == true ){
            $session = new Session();
            $_POST['msg'] = "Admin Information Updated";
            $this->message = $_POST['msg'];
            redirect_to("admin_list.php?msg=Admin Information Updated");
        } else {
            $message = "Sorry! ): something went wrong";
            $this->message = $message;
            return false;
        }
    }
   
   //function that reset passwords
    public function resetPassword(){
        //checks if the update form is posted
        if(isset($_POST['reset'])){
            $email          = $_POST['email'];
            $old_password   = $_POST['old_password'];
            $new_password = $_POST['new_password'];
            $v_password    = $_POST['v_password'];
            //$verify_password = $_POST['v_password'];
            // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input
            if ($this->validate_reset_input($email, $old_password, $new_password, $v_password) == true){
                //assigning the variable to the public vars
                $this->email         = $email;
                $this->new_password  = $new_password;
                $this->updatePassword();
            }else{

            }

        }
    }

    //update ward
    public function updatePassword(){
        $user = new User();
        $user->email    =  $this->email;
        $user->password =  $this->new_password;
        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;

        if($user->update_password_by_email($this->email, $this->new_password) == true ){
            $session = new Session();
            $_POST['msg'] = "Passsword Updated";
            $this->message = $_POST['msg'];
        } else {
            $message = "Sorry! ): something went wrong";
            $this->message = $message;
            return false;
        }
    }
    //function that validates user input for password reset
    public function validate_reset_input($email, $old_password, $new_password, $v_password){
            $user = new User();
            //checks for empty fields
            if(empty($email) || empty($old_password) || empty($new_password) || empty($v_password)){
                $message = "You left a blank field";
                $this->message = $message;
                return false;
            }

            //checks for invalid email
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $message= "Invalid Email, Please verify the mail";
                $this->message = $message;
                return false;
            }

            //checks if the EMAIL EXIST
            if($user->check_user_mail($email)){
                $message = "Unregistered Email";
                $this->message = $message;
                return false;
            }

            //check if the password matches and checkbox is checked
            if($new_password != $v_password){
                    $message = "Password doesn't match";
                    $this->message = $message;
                    return false;
            }

            //checks if the password is correct
            if(User::verify_password($email, $old_password)==false){
                $message = "Invalid User";
                $this->message = $message;
                return false;
            }
            return TRUE;
    }
    //Attribute Validation function
    public function validate_input($productId, $productName, $productSize, $productPrice, $productImage){
               
              //checks for empty fields
              if(empty($productId) || empty($productName) || empty($productPrice) || empty($productSize)  || empty($productImage)){        
                  $message = "You left a blank field";
                  $this->message = $message;
                  return false;
                    }
                      //validates email
                    if($this->validate_cart($productId) == false){
                     return false;             
                    }
                    return true;
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
    public function validate_cart($id){
                $cart = new Cart();
        
              //checks if the EMAIL EXIST
              if($cart->check_item_id($id) == false){
                $message = "Item Carted, Please select Another Item";
                $this->message = $message;
                return false;
              }
              return true;
    }
    
    //Registration method
    public function addCart(){
        
         $cart = new Cart();
         $cart->product_id = $this->productId;
         $cart->product_name =  $this->productName;  
         $cart->size = $this->product_size;
         $cart->product_price  = $this->productPrice;
         $cart->image  = $this->product_image;
         $cart->quantity = 1;
         //$user->image_path = "uploads\images\oyin.jpg"; //default image.
         //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
         //$user->password = $this->password;
         
         if($cart->create() == true ){
         //$session = new Session();
         $_POST['msg'] = "Carted";
         //$session->message("User Created, Login to Activate your session");
         //redirect_to("login.php");
         } else {
                 $message = "Sorry! ): something went wrong";
                 $this->message = $message;
                 return false;
         }
    }
   
    //ward deleting method
    public function deleteItem(){
        //pic Must have an id
        if(isset($_POST['del_key'])){
            $id = $_POST['id'];
            $carts = new Cart();
            if($carts && $carts->destroyCart($id)){
           
                $_GET['msg'] = "Cart Deleted Succesfully";
            } else {
                $_GET['msg'] = "Fail to Delete Cart!";
            }

        }


    }
        //cart update method
    public function updateEntry(){
        //pic Must have an id
        if(isset($_POST['up_key'])){
            $value     = $_POST['quantity'];
            $productId = $_POST['id'];
            $carts = new Cart();
            if($carts && $carts->updateCart($value, $productId)){
           
                $_GET['msg'] = "Cart Updated Succesfully";
            } else {
                $_GET['msg'] = "Fail to Update Cart!";
            }

        }


    }

}










