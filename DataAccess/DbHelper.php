<?php

class DbHelper {
    private $conn;

    private $host;
    private $dbName;
    private $username;
    private $password;

    public function __construct($host="studmysql01.fhict.local", $dbName="dbi453373", $username="dbi453373", $password="12345")
    {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->username = $username;
        $this->password = $password;
    }


    public function GetUsers()
    {
        try {

            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * from employee where ID= ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([1]);

            $result = $stmt->fetchAll();

            foreach ($result as $row)
            {
                $id = $row['ID'];

            }

            // Close DB connection
            $this->conn = null;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $id;
    }

}
?>