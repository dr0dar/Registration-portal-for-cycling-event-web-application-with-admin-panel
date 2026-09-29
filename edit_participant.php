<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update participants score</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
            font-family: 'Segoe UI', sans-serif;
        }

        .top-bar {
            background: #0f172a;
            color: white;
            padding: 15px 20px;
        }

        .container-box {
            max-width: 900px;
            margin: 30px auto;
            padding: 0 15px;
        }

        .result-card {
            background: white;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border-left: 4px solid #0d6efd;
        }

        .title {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .empty {
            text-align: center;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .back {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="top-bar">
        <a class="back" href="." >Back to index</a>
    </div>
    <div class="container-box">

    <?php
        
        //including connection variables   
        include 'dbconnect.php';

        try {
            if($_SERVER['REQUEST_METHOD'] == 'POST') //has the user submitted the form and edited the participant
            {
                
                $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); //building a new connection object
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //TODO - UPDATE section
                $query = $conn->prepare("UPDATE participant SET power_output=:power_output, distance=:distance WHERE id=:id");
                $success = $query->execute([
                    ':power_output' => $_POST['power_output'],
                    ':distance' => $_POST['distance_travelled'],
                    ':id' => $_POST['id']
                ]);

                if($success){
                   header("Location: view_participants_edit_delete.php");
                   exit();
                }
                else{
                    header("Location: edit_participant_form.php?edit=0");
                   exit();
                }

                
            }
            else{

                $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); //building a new connection object
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //TODO - SELECT section
                include "edit_participant_form.php"; 

            }
        }
        catch(PDOException $e)
            {
                echo $e->getMessage();//error stuff here
            }





























            /**
            * For the brave souls who get this far: You are the chosen ones,
            * the valiant knights of programming who toil away, without rest,
            * fixing our most awful code. To you, true saviors, kings of men,
            * I say this: never gonna give you up, never gonna let you down,
            * never gonna run around and desert you. Never gonna make you cry,
            * never gonna say goodbye. Never gonna tell a lie and hurt you.
            */
        ?>
    </div>

</body>
</html>