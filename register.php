<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register your interest</title>
</head>
<body>
    <?php
    //including connection variables  
    include 'dbconnect.php';



    if($_POST['terms']=='yes'){
        $term=1;
    }
    else{
        $term=0;
    }

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); //building a new connection object
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                //TODO INSERT - complete the functionality
                $query=$conn->prepare("INSERT INTO interest(firstname,surname,email,terms) VALUES(:fname,:sname,:email,:terms)");
                $success = $query->execute([
                    ':fname' => $_POST['firstname'],
                    ':sname' => $_POST['surname'],
                    ':email' => $_POST['email'],
                    ':terms' => $term,
                ]);
            

                if($success){
                   header("Location: index.html?success=1");
                   exit();
                }
                else{
                    header("Location: register_form.html?success=0");
                   exit();
                }

                }
            catch(PDOException $e)
                {
                echo $e->getMessage(); //If we are not successful we will see an error

                }

        ?>


</body>
</html>