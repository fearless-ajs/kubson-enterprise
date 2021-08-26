<?php
class Photograph extends DatabaseObject{
     //our database columns are attributes individually
    //database column variables
    protected static $table_name = "photographs";
    protected static $db_fields = array('id', 'filename', 'type', 'size',
    'caption'
    );
    
    public $id;
    public $filename;
    public $type;
    public $size;
    public $caption;
    
    private $temp_path;
    protected $upload_dir = "uploads\images";
    public $errors = array();
    
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
            //error: nothing uplosded or wrong argument usage
            $this->errors[] = "No file was uploaded.";
            return FALSE;
        }elseif ($file['error'] != 0) {
            //error report what php  says went wrong
            $this->errors[] = $this->uploads_errors[$file['error']];
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
    
    //custom image save method
    public function save(){
        //A new record won't have an id yet
        //update if there is an existing record
        if(isset($this->id)){
            //Really just to update the caption
            $this->update();
        } else {
            //Make sure there no errors
            
            //Can't save if there are pre-existing errors
            if(!empty($this->errors)){ return FALSE; }
            
            //Make sure the caption is not too long
            if (strlen($this->caption) > 255){
                $this->errors[] = "The caption is too long";
                return FALSE;
            }
            
            //Cant save without filename
            if(empty($this->filename) || empty($this->temp_path)){
                $this->errors[] = "The file location was not available";
                return FALSE;
            }
            
            //Determine the target_path
            $target_path = SITE_ROOT .DS. 'public' .DS. $this->upload_dir .DS. $this->filename;
            
            //Make sure a file doesn't already exist in the target location
            if(file_exists($target_path)) {
                $this->errors[] = "The file {$this->filename} already exist.";
                return FALSE;
            }
            //Attempt to move the file
            if(move_uploaded_file($this->temp_path, $target_path)){
                //Success
                // Save a corresponding entry to the database
                if($this->create()){
                    //We are done with temp_path, the file isn't there anymore
                    unset($this->temp_path);
                    return TRUE;
                }
            }else{
                //File was not moved
                $this->errors[] = "The file upload failed, possibly due to "
                        . "incorect permissions on the upload folder";
                return FALSE;
            }
        }
    }
    
     //for that delete images form the databse
     public function destroy(){
         //First remove the database entry
         if($this->delete()){//if database entry is deleted successfully
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

    //comments retrieval method
    public function comments(){
        return Comment::find_comments_on($this->id);
    }
     
    
    /* common Database Methods 
    * Moved into database object class
    * 
   */
        
    
}

