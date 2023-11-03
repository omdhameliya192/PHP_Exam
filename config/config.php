<?php 

class Config{
    public $HOSTNAME = "127.0.0.1";
    public $USERNAME = "root";
    public $PASSWORD = "";
    public $DB_NAME = "food";
    public $con_res;

    public function connect(){
        $this->con_res = mysqli_connect($this->HOSTNAME,$this->USERNAME,$this->PASSWORD,$this->DB_NAME);
        return $this->con_res;
    }

    public function insert($Name,$Image){
        $this->connect();
        $query = "INSERT INTO cat_food (Name,Image) VALUE('$Name',$Image);";

        $res = mysqli_query($this->con_res,$query);
        return $res;
    }

    public function select(){
        $this->connect();
        $query = "SELECT * FROM cat_food;";

        $res = mysqli_query($this->con_res,$query);
        
        return $res;
    }

    public function delete($id){
        $this->connect();
        $query = "DELETE FROM cat_food WHERE id=$id;";

        $res = mysqli_query($this->con_res,$query);
        return $res;
    }
}

?>