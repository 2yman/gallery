<?php


class User  
{

    protected static $db_table = "users";
    protected static $db_table_fields = ['username', 'password','first_name','last_name'];

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

    public static function findAllUsers()
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

    protected function properties()
    {
        $properties = [];
        foreach (self::$db_table_fields as  $db_field) {
            if (property_exists($this,$db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
            
        }
        return $properties;
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

    public static function verifyUser($username,$password)
    {
        global $database;
        $username = $database->escapeString($username);
        $password = $database->escapeString($password);
        $sql = "SELECT * FROM users WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";
        $resultArray = self::excuteQuery($sql);
        return !empty($resultArray) ? array_shift($resultArray) :false;


    }
    
    public function create()
    {
        global $database;
        $properties = $this->cleanProperties();

        $sql = "INSERT INTO " . self::$db_table . "(" . implode(",",array_keys($properties)) . ")";
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

        $sql = "UPDATE " . self::$db_table . " SET ";
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
        $sql = "DELETE FROM " . self::$db_table . " ";
        $sql .= "WHERE id=" . $database->escapeString($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return (mysqli_affected_rows($database->getConnection())== 1) ? true : false;
    }



}










?>