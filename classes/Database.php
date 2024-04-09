<?php

class Database
{
    public function connectDB(){
        $conn = mysqli_connect('localhost' , 'root' , '' , 'rbp');
        return $conn; 
    }
}
?>