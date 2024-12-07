<?php
function get_connection(){
    $user = "root";
        // on peut faire $host="127.0.0.1"; $dbname=data_school;
        $conn = "mysql:host=127.0.0.1;port=3306;dbname=vivote_db;";

        $password = "";
        try{
            $db = new PDO($conn,$user,$password);
        }catch(PDOException $e){
            die("could not connect to database : ". $e->getMessage());
        }
        return $db;
}
?>