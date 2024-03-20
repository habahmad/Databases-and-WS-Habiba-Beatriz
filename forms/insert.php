<?php

//checking if user submit data using post method
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if (isset($_POST['user_type']) && !empty($_POST['user_type'])) {
        $userType = $_POST["user_type"];
        $yr_lvl = $_POST["yr_lvl"];
        $name = $_POST["name"]; 
        $dob = $_POST["dob"];
        $gpa = $_POST["gpa"];
        $course = $_POST["course"];
        $elective = $_POST["elective"];
        $year = $_POST["year"];
        $dept = $_POST["dept"];
        $salary = $_POST["salary"];

        try{
            require_once "connect.php";

            if($userType == "student" && $yr_lvl == "1"){
                $query = "INSERT INTO 1st_2nd_yr_students (sName, dob, gpa, course, elective) VALUES (:name,:dob, :gpa, :course, :elective);"; //how to include sYear and sID?
            }
            if($userType == "student" && $yr_lvl == "2"){
                $query = "INSERT INTO 1st_2nd_yr_students (sName, dob, gpa, course, elective) VALUES (:name,:dob, :gpa, :course, :elective);"; //how to include option values?
            }
            if($userType == "student" && $yr_lvl == "3"){
                $query = "INSERT INTO 3rd_yr_students (sName, dob, gpa, course) VALUES (:name,:dob, :gpa, :course);"; 
            }
            if($userType == "student" && $yr_lvl == "4"){
                $query = "INSERT INTO 4th_yr_students (sName, dob, gpa, course) VALUES (:name,:dob, :gpa, :course);"; 
            }
            if($userType == "teacher"){
                $query = "INSERT INTO professors (pName, dob, department, salary) VALUES (:name,:dob, :dept, :salary);"; 
            }
             
            //submitting query to db, using prepared statements for security
            $stmt = $pdo->prepare($query);
    
            //giving the data user submitted using named parameters
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":dob", $dob);
            $stmt->bindParam(":gpa", $gpa);
            $stmt->bindParam(":course", $course);
            $stmt->bindParam(":elective", $elective);
            $stmt->bindParam(":dept", $dept);
            $stmt->bindParam(":salary", $salary);

            $stmt->execute();

            //manually freeing up resources
            $pdo = null;
            $stmt = null;

            die();
        }catch(PDOException $e){
            die("Query failed:" . $e->getMessage());
        }
    }
}