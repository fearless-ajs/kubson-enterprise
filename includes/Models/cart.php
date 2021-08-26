<?php
//calling our database class
require_once(LIB_PATH.DS.'Models'.DS.'database.php');
class Cart extends UserDatabaseObject {
    
    //our database columns are attributes individually
    //database column variables
    protected static $table_name = "cart";
    protected static $db_fields = array('id', 'product_id', 'product_name', 'size', 'quantity', 'product_price', 'image');

    public $id;
    public $product_id;
    public $product_name;
    public $size;
    public $quantity;
    public $product_price;
    public $image;
    public $sum_value;
    //public $image_path;
    //public $reg_date;
    //public $password;
   

    //function that returns user full name
     public function full_name(){
        if(isset($this->first_name) && isset($this->last_name)){
            return $this->first_name . "  " . $this->last_name;
        } else {
            return " ";
        }
    }

    //function to check if user is registered
    public static function verify_user($email="", $password=""){
        global $database;
        $email = $database->escape_value($email);
        $password = $database->escape_value($password);
        
        //cheeck if the email is registered
        if(self::check_user_mail($email) == true){ //true here in this case means there is no record with that mail in the database 
            $_POST['msg'] = "Invalid Email (:";
            return false;
        }
        //checks if the password is correct
        if(self::verify_password($email, $password)==false){
           $_POST['msg'] = "Invalid Password (:";
            return false;
        }
        return true;
    }
    
    //function that validates if mail is registered.
    public static function check_item_id($id){
        global $database;
        $sql  = " SELECT * FROM ". static::$table_name . "";
        $sql .= " WHERE product_id = '{$id}' ";
        $sql .= " LIMIT 1";
      
        $result_set = $database->query($sql);
        if($database->num_rows($result_set) == 1){
             return false;
        }else{
           return true;
        }
  
    }

    //hashed_password verification function 
    public static function  verify_password($email, $password){
        global $database;
        $sql  = " SELECT * FROM ". static::$table_name . "";
        $sql .= " WHERE email = '{$email}' ";
        $sql .= " LIMIT 1";
        $result_set = $database->query($sql);
        $record = $database->fetch_array($result_set);
       // $hashed_password = base64_encode(strrev(md5($password)));
        
        if($record['password'] != $password){
           return false;
        }
        return true;
    }
    
    //user authentication Method
    public static function authenticate($email=""){
        global $database;
        
        $email = $database->escape_value($email);

        $sql  = " SELECT * FROM " . static::$table_name . "";
        $sql .= " WHERE email = '{$email}' ";
        $sql .= " LIMIT 1";

        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }
    
        //for that delete users form the databse
    public function destroyCart($ID){
        //First remove the database entry
        if($this->deleteUser($ID)){//if database entry is deleted successfully
            //Then remove the file
            return TRUE;
        } else {
            //database delete failed
            return FALSE;
        }
    }
//for that delete users form the databse
    public function updateCarxt($value, $productId){
        //First remove the database entry
        if($this->update_cart_quantity($value, $productId)){//if database entry is deleted successfully
            //Then remove the file
            return TRUE;
        } else {
            //database delete failed
            return FALSE;
        }
    }
    
    //function for updating carts
    

 
   /* common Database Methods that performs the database operation has been
    * Moved into databaseObject class
    * 
   */
    

   }

    

   
