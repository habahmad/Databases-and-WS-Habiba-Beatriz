<!-- php code that queries db and searches for data-->
<?php

//checking if user submit data using post method
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //making sure a query is selected 
    if (isset($_POST['query_type']) && !empty($_POST['query_type'])) {
        $query_type = $_POST["query_type"];

        try{
            //establishing connection to db
            require_once "connect.php";

            //executing query according to selected query
            if($query_type == "query1"){
                $query = "SELECT * FROM professors WHERE pID = 0002;"; 
            }
            if($query_type == "query2"){
                $query = "SELECT sName FROM 1st_2nd_yr_students WHERE elective = 'Physical Education';";
            }
            if($query_type == "query3"){
                $query = "SELECT members.mName, 3rd_yr_students.gpa FROM members JOIN 3rd_yr_students ON members.mID = 3rd_yr_students.sID;"; 
            }
            if($query_type == "query4"){
                $query = "SELECT sID, sName, course FROM 1st_2nd_yr_students WHERE sYear = 'freshman' ORDER BY sName DESC;"; 
            }
            if($query_type == "query5"){
                $query = "SELECT pID, pName, salary FROM professors GROUP BY pID HAVING max(salary) > 9000;"; 
            }
            if($query_type == "query6"){
                $query = "SELECT members.mName, professors.salary FROM members JOIN professors ON members.mID = professors. pID ORDER BY mName;"; 
            }

            //submitting and executing query 
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            //fetching and storing required data in an associative array
            $results = $stmt->fetchAll (PDO::FETCH_ASSOC);

            //manually freeing up resources
            $pdo = null;
            $stmt = null;
        
        //error handling
        }catch(PDOException $e){
            die("Query failed:" . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

		<script>
		</script>
	</head>
	
	<body style="margin: 50px;">

    <section>

		<h1> Query search results: </h1>

        <?php
        //checking if search result exists
        if(empty($results)){
            echo "<div>";
            echo "<p>No results for selected query</p>";
            echo "</div>";
        }else{
            //outputs db tables according to selected query
            foreach($results as $rows){
                if($query_type == "query1"){
                    //exiting out of php code to format output tables in html
                    ?> 
                    <table class="table">
                        <thead>
                            <tr>
                                <th>pID</th>
                                <th>pName</th>
                                <th>dob</th>
                                <th>department</th>
                                <th>salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //sanitizing data before outputing it 
                             echo "<tr>
                             <td>". htmlspecialchars($row["pID"]). "</td>
                             <td>". htmlspecialchars($row["pName"]). "</td>
                             <td>". htmlspecialchars($row["dob"]). "</td>
                             <td>". htmlspecialchars($row["department"]). "</td>
                             <td>". htmlspecialchars($row["salary"]). "</td>
                             </tr>";            
                            ?>
                        </tbody>
                    </table>
                    <?php
                }
                if($query_type == "query2"){
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>sName</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             echo "<tr>
                             <td>". htmlspecialchars($row["sName"]). "</td>                           
                             </tr>";            
                            ?>
                        </tbody>
                    </table>
                    <?php
                }
                if($query_type == "query3"){
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>mName</th>
                                <th>gpa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             echo "<tr>
                             <td>". htmlspecialchars($row["mName"]). "</td>
                             <td>". htmlspecialchars($row["gpa"]). "</td>
                             </tr>";            
                            ?>
                        </tbody>
                    </table>
                    <?php 
                }
                if($query_type == "query4"){
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>sID</th>
                                <th>sName</th>
                                <th>course</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             echo "<tr>
                             <td>". htmlspecialchars($row["sID"]). "</td>
                             <td>". htmlspecialchars($row["sName"]). "</td>
                             <td>". htmlspecialchars($row["course"]). "</td>
                             </tr>";            
                            ?>
                        </tbody>
                    </table>
                    <?php 
                }
                if($query_type == "query5"){
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>pID</th>
                                <th>pName</th>
                                <th>salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             echo "<tr>
                             <td>". htmlspecialchars($row["pID"]). "</td>
                             <td>". htmlspecialchars($row["pName"]). "</td>
                             <td>". htmlspecialchars($row["salary"]). "</td>
                             </tr>";            
                            ?>
                        </tbody>
                    </table>
                    <?php 
                }
                if($query_type == "query6"){
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>mName</th>
                                <th>salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             echo "<tr>
                             <td>". htmlspecialchars($row["mName"]). "</td>
                             <td>". htmlspecialchars($row["salary"]). "</td>
                             </tr>";            
                            ?>
                        </tbody>
                    </table>
                    <?php 
                }
            }
        } 
        ?>

    </section>

	</body>
</html>