<?php
//require_once(LIB_PATH.DS. 'Helpers'.DS.'initialize.php');

class KidsImageProcessor{
    /************Image processing Parameters*************/
    //file names
    public $full_view_filename;
    public $front_view_filename;
    public $back_view_filename;
    public $side_view_filename;
    //file types
    public $full_view_type;
    public $front_view_type;
    public $back_view_type;
    public $side_view_type;
    //file sizes
    public $full_view_size;
    public $front_view_size;
    public $back_view_size;
    public $side_view_size;
    //file temprorary paths
    private $full_view_temp_path;
    private $front_view_temp_path;
    private $back_view_temp_path;
    private $side_view_temp_path;
    //file targetpath
    public $full_view_target_path;
    public $front_view_target_path;
    public $back_view_target_path;
    public $side_view_target_path;

    //file_upload_directory
    protected $upload_dir = "uploads\images\kids";
    public  $errors = array();
    /************End of Image processing Parameters**********/
    
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

    
    //constructor that accepts the image parameters parameters
    public function __construct() {
        
    }
    //function that takes the parameters
    public function imageSanitizer($full_view_file, $front_view_file, $back_view_file, $side_view_file){
        $this->attach_file($full_view_file, $front_view_file, $back_view_file, $side_view_file);
    }
    
    //Pass in $_FILE(['uploaded_file']) as an argument
    public function attach_file($full_view_file, $front_view_file, $back_view_file, $side_view_file){
        //Perform error checking on the form parameters
        if((!$full_view_file  || empty($full_view_file)   || !is_array($full_view_file)) ||
           (!$front_view_file || empty($front_view_file)  || !is_array($front_view_file)) ||
           (!$back_view_file  || empty($back_view_file)   || !is_array($back_view_file)) || 
           (!$side_view_file  || empty($side_view_file)   || !is_array($side_view_file))){
            //error: nothing uploaded or wrong argument usage
            $this->errors[] = "No file was uploaded.";
            $message = "Some Image Files Were Missing";
            $this->message = $message;
            return FALSE;
        }elseif ($full_view_file['error'] != 0 || $front_view_file['error'] != 0 || 
                $back_view_file['error'] != 0 || $side_view_file['error'] != 0) {
            //error report what php  says went wrong
            $this->errors[] = $this->uploads_errors[$full_view_file['error']] . $this->uploads_errors[$front_view_file['error']].
            $this->uploads_errors[$back_view_file['error']]. $this->uploads_errors[$side_view_file['error']];
            //second line that converst the errors to a message
            $message = $this->uploads_errors[$full_view_file['error']] . $this->uploads_errors[$front_view_file['error']].
            $this->uploads_errors[$back_view_file['error']]. $this->uploads_errors[$side_view_file['error']];
            $this->message = $message;
            return FALSE;
        }else{
            //Set object attributes to the form parameters
            $this->parameterSetter($full_view_file, $front_view_file, $back_view_file, $side_view_file);
            return TRUE;
            //and make it ready to be saved in the database
        }

    }
    
    //images parameter setter method
    public function parameterSetter($full_view_file, $front_view_file, $back_view_file, $side_view_file){
                    //setting the temporary paths
            $this->full_view_temp_path  = $full_view_file['tmp_name'];
            $this->front_view_temp_path = $front_view_file['tmp_name'];
            $this->back_view_temp_path  = $back_view_file['tmp_name'];
            $this->side_view_temp_path  = $side_view_file['tmp_name'];
            
            //setting the filenames
            $this->full_view_filename   = basename($full_view_file['name']);
            $this->front_view_filename  = basename($front_view_file['name']);
            $this->back_view_filename   = basename($back_view_file['name']);
            $this->side_view_filename   = basename($side_view_file['name']);
           
            //setting the file types
            $this->full_view_type       = $full_view_file['type'];
            $this->front_view_type      = $front_view_file['type'];
            $this->back_view_type       = $back_view_file['type'];
            $this->side_view_type       = $side_view_file['type'];
            //setting the file size
            $this->side_view_size       = $side_view_file['size'];
            $this->side_view_size       = $side_view_file['size'];
            $this->side_view_size       = $side_view_file['size'];
            $this->side_view_size       = $side_view_file['size'];
    }
    
    //image processing function
    public function imageProcessor(){

        //Can't save if there are pre-existing errors
        if(!empty($this->errors)){ return FALSE; }

        //Cant save without filename
        if((empty($this->full_view_filename)  || empty($this->full_view_temp_path)) ||
           (empty($this->side_view_filename)  || empty($this->side_view_temp_path)) ||
           (empty($this->back_view_filename)  || empty($this->back_view_temp_path)) ||
           (empty($this->front_view_filename) || empty($this->front_view_temp_path))){
            $this->errors[] = "Some files location was not available";
            $message = "Some files location was not available";
            $this->message = $message;
            return FALSE;
        }

        //Determine the target_paths
        $full_view_target_path  =  $this->upload_dir .DS. $this->full_view_filename;
        $front_view_target_path =  $this->upload_dir .DS. $this->front_view_filename;
        $back_view_target_path  =  $this->upload_dir .DS. $this->back_view_filename;
        $side_view_target_path  =  $this->upload_dir .DS. $this->side_view_filename;
        
        //seting th target paths parameters
        $this->full_view_target_path  = $full_view_target_path;
        $this->front_view_target_path = $front_view_target_path;
        $this->back_view_target_path  = $back_view_target_path;
        $this->side_view_target_path  = $side_view_target_path;

       //make sure the file doesn't exist
        if($this->checkFile($full_view_target_path, $front_view_target_path, $back_view_target_path, $side_view_target_path) == false){
            return false;
        } 
         //Attempt to move the file
        if($this->moveFile($full_view_target_path, $front_view_target_path, $back_view_target_path, $side_view_target_path)==false ){
            return false;
            
        } 
        //final return statement if everything is successful
         return true;    
       
    }
    
    //function that checks if the files exist
    public function checkFile($full_view_target_path, $front_view_target_path, $back_view_target_path, $side_view_target_path){
         //Make sure a file doesn't already exist in the target location
        if(file_exists($full_view_target_path)) {
            $this->errors[] = "The file {$this->full_view_filename} already exist.";
            $message = "The file {$this->full_view_filename} already exist.";
            $this->message = $message;
            return FALSE;
        }
         if(file_exists($front_view_target_path)) {
            $this->errors[] = "The file {$this->front_view_filename} already exist.";
            $message = "The file {$this->front_view_filename} already exist.";
            $this->message = $message;
            return FALSE;
        }
         if(file_exists($back_view_target_path)) {
            $this->errors[] = "The file {$this->back_view_filename} already exist.";
            $message = "The file {$this->back_view_filename} already exist.";
            $this->message = $message;
            return FALSE;
        }
         if(file_exists($side_view_target_path)) {
            $this->errors[] = "The file {$this->back_view_filename} already exist.";
            $message = "The file {$this->back_view_filename} already exist.";
            $this->message = $message;
            return FALSE;
        }
        return true;
    }
   
    //function that moves the files
    public function moveFile($full_view_target_path, $front_view_target_path, $back_view_target_path, $side_view_target_path){
           if(move_uploaded_file($this->full_view_temp_path, $full_view_target_path) && 
           move_uploaded_file($this->front_view_temp_path, $front_view_target_path) &&
           move_uploaded_file($this->back_view_temp_path, $back_view_target_path) &&
           move_uploaded_file($this->side_view_temp_path, $side_view_target_path)) {
               
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
    
    //image upload path
    public function image_path(){
        return $this->upload_dir.DS.$this->filename;
    }
    
    
}


