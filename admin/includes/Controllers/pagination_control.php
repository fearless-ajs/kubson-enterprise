<?php

class Pagination{
    public $current_page;
    public $per_page;
    public $total_count;
    
    public function __construct($page=1, $per_page=20, $total_count=0) {
        $this->current_page = (int)$page;
        $this->per_page     = (int)$per_page;
        $this->total_count  = (int)$total_count;
    }

    //function that calculates our offset
    public function offset(){
    //Assuming 20 items per page
    //page 1 has an offset of 0 (1 - 1) * 20
    //page 2 has an offset of 20 (2 - 1) * 20
    //in other words page two starts with item 21
    return ($this->current_page - 1) * $this->per_page;
    }
    //function that calculates the number of pages rerquired
    //to display all the records
    public function total_pages(){
        return ceil($this->total_count/$this->per_page);
    }
    
    //previous page
    public function previous_page(){
        return $this->current_page - 1;
    }
    
    //next page
    public function next_page(){
        return $this->current_page + 1;
    }
    
    //check if there is a previous page to the current page
    public function has_prevoius_page(){
        return $this->previous_page() >= 1 ? TRUE : FALSE;
    }
    
    //check if there is a next page to the current page
    public function has_next_page(){
        return $this->next_page() <= $this->total_pages() ? TRUE : FALSE;
    }
    
    /***
     * The function that initializes
     * the Numbering of pages, with
     * Previous and Next Button,
     *   
     */
    //The Main Page Navigation method
    public function page_navigator(){
         if($this->total_pages() > 1){        
        return $this->previous_button() + 
               $this->page_numbering() +
               $this->next_button();
         }           
    }
    
    //previous buttuon function
    public function previous_button(){
            if($this->has_prevoius_page()){
            echo "<a href=\"{$_SERVER['PHP_SELF']}?page=";
            echo $this->previous_page();
            echo "\">&laquo; Previous</a> ";
            
        } 
    }
    
    //Next Button function
    public function next_button(){
            if($this->has_next_page()){
            echo "<a href=\"{$_SERVER['PHP_SELF']}?page=";
            echo $this->next_page();
            echo "\">&raquo; Next</a> ";
        }
        
    }
    
    //page numbering function'
    public function page_numbering(){
             for($i=1; $i <= $this->total_pages(); $i++){
             if($i == $this->current_page){
                 echo " <span class=\"selected\">{$i}</span> ";
             } else {
                 echo " <a href=\"index.php?page={$i}\">{$i}</a> "; 
             }
           
        }
    }
    
    
}

