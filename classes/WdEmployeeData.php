<?php

class WdEmployee
{
    public $id;
    public $name;
    public $position;
    public $office;
    public $age;
    public $startdate;
    public $salary;


    public static function getAll ($conn){
        $query = "SELECT * FROM wdemployeedata";
        $stmt = mysqli_query($conn, $query);
        return mysqli_fetch_all($stmt , MYSQLI_ASSOC);    
    }

    public static function getById ($conn , $id){
        $query = 'SELECT * from wdemployeedata where id =?';
        $stmt = $conn->prepare( $query );
        mysqli_stmt_bind_param( $stmt, 'i', $id );
        if(mysqli_stmt_execute( $stmt)){
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_assoc($result);
        }
    }

    public function updateOne( $conn, $id){
        $query = ' UPDATE SET wdemployeedata name = :name , postion = :postion , office = :office
        ,age = :age, startdate = :startdate , salary = :salary WHERE id = :id';
    }

    public static function deleteOne($conn , $id){
        $query = 'DELETE FROM wdemployeedata WHERE id = ?' ;
        $stmt = mysqli_prepare( $conn , $query );
        mysqli_stmt_bind_param( $stmt ,  "i" , $id ) ;                    
        return $stmt->execute();

        $selectAll_qry = "SELECT * FROM wdemployeedata WHERE id = ?";
        $stmt = mysqli_prepare($conn, $selectAll_qry);
        mysqli_stmt_bind_param($stmt, "i", $id);

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

    }
    
    public static function createOne(){
        $query = "INSERT INTO wdemployeedata (name, position, office, age, startdate , salary) VALUES (:name , :position , :office, :age, :startdate , :salary)";
    }

    public static function totalSum($conn){
        $qry = "SELECT Sum(salary) as salary from wdemployeedata";
        $result = mysqli_query($conn, $qry);
        return mysqli_fetch_assoc($result);
    }
}


?>
