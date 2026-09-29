<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete participant</title>
</head>
<body>
    <?php
       
    include 'dbconnect.php';

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); //building a new connection object
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                //TODO DELETE - complete the functionality
                $query = $conn->prepare("DELETE FROM Participant WHERE id=:id");
                $exec = $query->execute([
                    ':id' => $_GET['id']
                ]);
                
                if($exec){
                   header("Location: view_participants_edit_delete.php?delete=1");
                   exit();
                }
                else{
                    header("Location: view_participants_edit_delete.php?delete=0");
                   exit();
                }

                }
            catch(PDOException $e)
                {
                echo $e->getMessage();// put the error stuff here
                }

        ?>

</body>
</html>