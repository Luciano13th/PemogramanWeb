<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class User { 

    private $conn;
    private $table = "user";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function create($username, $email, $asal, $password)
    {
        $sql = "INSERT INTO $this->table (username, email, asal, password) 
                VALUES ('$username', '$email', '$asal', '$password')";

        if ($this->conn->query($sql)) {
            echo "Data berhasil ditambahkan <br>";
        } else {
            echo "Error: " . $this->conn->error;
        }
    }

   public function login($username, $password)
{
    $sql = "SELECT * FROM " . $this->table .
           " WHERE username = '$username'
           AND password = '$password'";

    $result = $this->conn->query($sql);

    if ($result && $result->num_rows == 1){ 
        return true; 
    }
    
    return false; 
}
}