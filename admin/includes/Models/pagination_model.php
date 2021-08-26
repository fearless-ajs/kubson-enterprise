<?php
require_once(LIB_PATH.DS. 'Helpers'.DS.'initialize.php');
class PaginationObject {
    //Activating our pagination system

    public $page;
    public $table_name = 'photographs';
    public $per_page = 2;
    
    public function __construct($page, $table_name="", $per_page=0) {
        $this->page           = (int)$page;
        $this->table_name     = $table_name;
        $this->per_page       = (int)$per_page;
    }
    
    //1. The function that gets the current page number($current_page)
    public function current_page(){
        $page = !empty($_GET['page']) ? (int)$_GET['page']: 1;
        return $this->page  = $page;   
    }

    //3. function that returns total record count ($total_count)
    public function record_counter(){
        return $total_count = Photograph::count_all();
    }
    
    //function that returns the offset for pagination
    public function paging_offset(){
        $page         = $this->current_page();
        $per_page     = $this->per_page;
        $total_count  = $this->record_counter();   
        $pagination   = new Pagination($page, $per_page, $total_count);
        return $pagination;
    }
    
    //public function that get all the record int the table
    public function get_all_record(){
     
        $page         = $this->current_page();
        $per_page     = $this->per_page;
        $total_count  = $this->record_counter();     
        $pagination   = new Pagination($page, $per_page, $total_count);
        $offset       = $pagination->offset();
        //instead of finding all records, just find the record 
        //for this page
        $sql  = "SELECT * FROM {$this->table_name} ";
        $sql .= "LIMIT {$per_page} ";
        $sql .= "OFFSET {$offset}";
        return $photos = Photograph::find_by_sql($sql);
    
    }
    
}

