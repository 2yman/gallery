<?php


class User  
{

    public $id ;
    public $username ;
    public $password ;
    public $first_name ;
    public $last_name ;



    public static function excuteQuery($sql)
    {
        global $database;
        $resultSet = $database->query($sql);
        $the_object_array = [];
        while ($row = mysqli_fetch_array($resultSet)) {
            $the_object_array[] = self::instantation($row);
        }
        return $the_object_array;
    }

    public static function findAllUsers(Type $var = null)
    {
       return self::excuteQuery("SELECT * FROM users");
    }

    public static function findUserById($id)
    {
        $resultArray = self::excuteQuery("SELECT * FROM users WHERE id=$id");
        return !empty($resultArray) ? array_shift($resultArray) :false;
    }

    public function instantation($founduser)
    {
        $u = new self;
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