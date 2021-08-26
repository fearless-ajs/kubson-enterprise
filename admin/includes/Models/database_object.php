<?php
/*
 * if it's going to need the database, then it's
 * probably smart to require it first
 */
require_once(LIB_PATH.DS. 'Models'.DS.'database.php');

class DatabaseObject
{
    //function that get all results from sql query
    public static function find_all()
    {
        global $database;
        $result_set = self::find_by_sql("SELECT * FROM " . static::$table_name);
        return $result_set;
    }

    //function that get all results by id
    public static function find_by_id($id = 0)
    {
        global $database;
        $result_array = self::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE id={$id} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }
    public static function find_by_Specialist_ID($id)
    {
        global $database;
        $result_array = self::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE DoctorID={$id} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    //function that get all results by wardname
    public static function find_by_ward_name($wardname = "")
    {
        global $database;
        $result_array = self::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE wardname='$wardname' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    //function that get all results by room number
    public static function find_by_RoomNo($RoomNo = "")
    {
        global $database;
        $result_array = self::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE RoomNo='$RoomNo' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    public static function find_by_Staff_ID($ID)
    {
        global $database;
        $result_array = self::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE ID='$ID' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }
    public static function find_by_Patient_ID($ID)
    {
        global $database;
        $result_array = self::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE PatientID='$ID' LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }

    //function that get by sql
    public static function find_by_sql($sql = "")
    {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)) {
            $object_array[] = static::instantiate($row);
        }
        return $object_array;
    }

    //function that counts records in a table
    public static function count_all()
    {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    //function that instantiate the database records
    private static function instantiate($record)
    {
        $class_name = get_called_class();
        $object = new $class_name;
        // $object->id = $record['id'];
        // $object->username   = $record['username'];
        // $object->password   = $record['password'];
        // $object->first_name = $record['first_name'];
        // $object->last_name  = $record['last_name'];

        //more dynamic, short form appraoch
        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    //function to check the existence of an array key
    private function has_attribute($attribute)
    {
        //get object vars returns an associateive array with all attribute
        //(incl. private ones!) as the key their current values as the value
        $object_vars = get_object_vars($this);
        //just want to know if the value exists
        //will return true or false
        return array_key_exists($attribute, $object_vars);
    }

    //attrubutes fuction that returns the key of table
    protected function attributes()
    {
        //return an array of attributes keys and their values
        $attributes = array();
        foreach (static::$db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    //sanitised attributes with escape value
    protected function sanitized_attributes()
    {
        global $database;
        $clean_attributes = array();
        //sanitize the values befor submitting
        //Note: does not alter the actual value of eack attribute
        foreach ($this->attributes() as $key => $value) {
            $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }

    //Function that for the existence of the record
    //if not exist then it creates it
    public function save()
    {
        //A new function won't have an id yet
        return isset($this->id) ? $this->update() : $this->create();
    }

    //The craete user function
    public function create()
    {
        global $database;
        //Don't forget your SQL syntax and good habits
        // - INSERT INTO table (key, key) VALUES('value', 'value')
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        if ($database->query($sql)) {
            $this->id = $database->insert_id();
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //the update user function
    public function update_by_RoomNo($RoomNo = "")
    {
        global $database;
        //Don't forget your SQL syntax and good habits
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $attributes_pairs = array();
        foreach ($attributes as $key => $value) {
            $attributes_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(", ", $attributes_pairs);
        $sql .= " WHERE RoomNo='$RoomNo'";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }
    //the update ward function
    public function update_by_wardname($wardname = "")
    {
        global $database;
        //Don't forget your SQL syntax and good habits
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $attributes_pairs = array();
        foreach ($attributes as $key => $value) {
            $attributes_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(", ", $attributes_pairs);
        $sql .= " WHERE wardname='$wardname'";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }
    //the update password function
    public function update_password_by_email($email, $password)
    {
        global $database;
        //Don't forget your SQL syntax and good habits
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        //$attributes = $this->sanitized_attributes();
        //$attributes_pairs = array();
        //foreach ($attributes as $key => $value) {
            //$attributes_pairs[] = "{$key}='{$value}'";
        //}

        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= "password = '$password'";
        $sql .= " WHERE email='$email'";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }

    //the update user function
    public function update_by_Staff_ID($ID = "")
    {
        global $database;
        //Don't forget your SQL syntax and good habits
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $attributes_pairs = array();
        foreach ($attributes as $key => $value) {
            $attributes_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(", ", $attributes_pairs);
        $sql .= " WHERE ID='$ID'";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }
    //the update user function
    public function update_by_Patient_ID($ID = "")
    {
        global $database;
        //Don't forget your SQL syntax and good habits
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $attributes_pairs = array();
        foreach ($attributes as $key => $value) {
            $attributes_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(", ", $attributes_pairs);
        $sql .= " WHERE PatientID='$ID'";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }

    //the update  function
    public function update_by_id($ID = "")
    {
        global $database;
        //Don't forget your SQL syntax and good habits
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $attributes_pairs = array();
        foreach ($attributes as $key => $value) {
            $attributes_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(", ", $attributes_pairs);
        $sql .= " WHERE id='$ID'";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }

    //the update  function
    public function update_by_discharge_ID($ID = "", $status , $d_date)
    {
        global $database;
        //Don't forget your SQL syntax and good habits
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $attributes_pairs = array();
        foreach ($attributes as $key => $value) {
            $attributes_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$table_name . " SET";
        $sql .= " status='{$status}', discharge_date='{$d_date}' ";
        $sql .= " WHERE PatientID='{$ID}'";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }



    //the update user function
    public function update()
    {
        global $database;
        //Don't forget your SQL syntax and good habits
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $attributes_pairs = array();
        foreach ($attributes as $key => $value) {
            $attributes_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE" . self::$table_name . " SET ";
        $sql .= join(", ", $attributes_pairs);
        $sql .= " WHERE id=" . $database->escape_value($this->id);
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }

    //the delete user function
    public function delete()
    {
        global $database;
        //Don't forget your SQL syntax and good habits
        // - DELETE FROM table WHERE condition LIMIT 1
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $sql = "DELETE  FROM " . static::$table_name;
        $sql .= " WHERE id= " . $database->escape_value($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;

    }

    public function deleteWard($wardname){
        global $database;
        //Don't forget your SQL syntax and good habits
        // - DELETE FROM table WHERE condition LIMIT 1
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $sql = "DELETE  FROM " . static::$table_name;
        $sql .= " WHERE wardname='$wardname'" ;
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }
    public function deleteRoom($RoomNo){
        global $database;
        //Don't forget your SQL syntax and good habits
        // - DELETE FROM table WHERE condition LIMIT 1
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $sql = "DELETE  FROM " . static::$table_name;
        $sql .= " WHERE RoomNo='$RoomNo'" ;
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }

    //function that deletes staffs
    public function deleteItem($ID){
        global $database;
        //Don't forget your SQL syntax and good habits
        // - DELETE FROM table WHERE condition LIMIT 1
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $sql = "DELETE  FROM " . static::$table_name;
        $sql .= " WHERE id='$ID'" ;
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }

    //function that deletes doctors
    public function deleteUser($ID){
        global $database;
        //Don't forget your SQL syntax and good habits
        // - DELETE FROM table WHERE condition LIMIT 1
        // - single - quotes around all values
        // - escape all values to prevent SQL injection
        $sql = "DELETE  FROM " . static::$table_name;
        $sql .= " WHERE id='$ID'" ;
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? TRUE : FALSE;
    }



}