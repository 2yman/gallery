<?php

class Db_model  
{


    public static function findAll()
    {
       return static::findByQuery("SELECT * FROM " . static::$db_table . " ");
    }

    public static function findById($id)
    {
        $resultArray = static::findByQuery("SELECT * FROM " . static::$db_table . " WHERE id=$id");
        return !empty($resultArray) ? array_shift($resultArray) :false;
    }

    public static function findByQuery($sql)
    {
        global $database;
        $resultSet = $database->query($sql);
        $the_object_array = [];
        while ($row = mysqli_fetch_array($resultSet)) {
            $the_object_array[] = static::instantation($row);
        }
        return $the_object_array;
    }



    private function hasAttribute($key)
    {
      $object_properties = get_object_vars($this);
      return array_key_exists($key,$object_properties);
    }

    protected function properties()
    {
        $properties = [];
        foreach (static::$db_table_fields as  $db_field) {
            if (property_exists($this,$db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
            
        }
        return $properties;
    }

    public static function instantation($founduser)
    {
        $callingClass = get_called_class();
        $u = new $callingClass;
        foreach ($founduser as $key => $value) {
            if($u->hasAttribute($key)){
                $u->$key = $value;
            }
        }
        return $u;
    }

    protected function cleanProperties()
    {
        global $database;
        $cleanProperties = [];
        foreach ($this->properties() as $key => $value) {
            $cleanProperties[$key] = $database->escapeString($value);
        }
        return $cleanProperties;
    }

    public function create()
    {
        global $database;
        $properties = $this->cleanProperties();

        $sql = "INSERT INTO " . static::$db_table . "(" . implode(",",array_keys($properties)) . ")";
        $sql .= "VALUES('" . implode("','",array_values($properties)) . "')";
        if($database->query($sql)){
            $this->id = $database->theInsertId();
            return true;
        }else {
            return false;
        }
    }

    public function update()
    {
        global $database;
        $properties = $this->cleanProperties();
        $properties_pairs = [];
        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key}='{$value}'"; 
        }

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(",",$properties_pairs);
        $sql .= " WHERE id= "  . $database->escapeString($this->id);
        $database->query($sql);
        return (mysqli_affected_rows($database->getConnection())== 1) ? true : false;
    }

    public function save()
    {
        return isset($this->id)? $this->update() : $this->create();
    }

    public function delete()
    {
        global $database;
        $sql = "DELETE FROM " . static::$db_table . " ";
        $sql .= "WHERE id=" . $database->escapeString($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return (mysqli_affected_rows($database->getConnection())== 1) ? true : false;
    }






}





?>