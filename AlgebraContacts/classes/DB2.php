<?php

class DB {

    private static $instance = null;
    private $connection;


    private function __construct(){  

        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'algebra_contacts';

        $dsn = "mysql:dbname=$db;host=$host";

        try {
            $this->connection = new PDO($dsn,$user,$pass);
            echo "Connected succesfully";
        } catch (PDOException $e) {
            die($e->getMessage());  //malo smo zločkasti
        }
        
    }  

    public static function getInstance(){

        if (!self::$instance) {
           self::$instance = new DB();  
        }
        return self::$instance;
    }

    private function action($query){
        $result = $this->connection->prepare($query);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_OBJ);
    }


    }

   /* public function deleteById($table,$id){
        return $this->action("DELETE FROM $table WHERE id = $id");
    }*/

    public function select($fields, $table, $where= array()){

        if ($where){
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            $sql = "SELECT $fields FROM $table WHERE $field $operator $value";
        
        }else{
            $sql = "SELECT $fields FROM $table";
        }
        return $this->action($sql);
    }

    public function delete($table,$where){
        $sql = "DELETE FROM $table WHERE $where";
        return $this->action($sql);
    }
}

$db = DB::getInstance();
// $result = $db->action("select imeStud, prezStud from stud");
//var_dump($result);

//$result = $db->action("DELETE FROM stud WHERE mbrStud = 1120");

$result = $db->delete('users','id= 1');
//$result = $db->select('*','stud', 'mbrStud = 1120');
$result = $db->select('*','users', ['id', '=', 1]);

//$result = $db->select('*','stud');

var_dump($result);

/*foreach ($result as $key => $student) {
    echo "<p>$student->imeStud</p>";
    echo "<p>$student->prezStud</p>";
}*/

