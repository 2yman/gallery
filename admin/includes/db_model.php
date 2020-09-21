<?php

class Db_model  
{
    
    public static function findAll()
    {
       return static::excuteQuery("SELECT * FROM " . static::$db_table . " ");
    }

    public static function findById($id)
    {
        $resultArray = static::excuteQuery("SELECT * FROM " . static::$db_table . " WHERE id=$id");
        return !empty($resultArray) ? array_shift($resultArray) :false;
    }

    public static function excuteQuery($sql)
    {
        global $database;
        $resultSet = $database->query($sql);
        $the_object_array = [];
        while ($row = mysqli_fetch_array($resultSet)) {
            $the_object_array[] = static::instantation($row);
        }
        return $the_object_array;
    }

    public function instantation($founduser)
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

    private function hasAttribute($key)
    {
      $object_properties = get_object_vars($this);
      return array_key_exists($key,$object_properties);
    }







}





?>