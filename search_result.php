<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search results</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


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

        a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <!-- Top bar -->
    <div class="top-bar">
        
                <div class="top-bar d-flex align-items-center justify-content-between">
        
                <!-- LEFT: Title -->
                <a href="search_form.php" class="back-link">
                    <i class="bi bi-arrow-left"></i>
                </a>

                <div class="dashboard-title mt-2 fw-bold d-flex fs-4 justify-content-center">Search Results</div>

                <!-- RIGHT: Logout -->
                <a href="." class="btn btn-danger btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>

            </div>
    </div>

<div class="container-box">

    <?php
        
            
        include 'dbconnect.php';
        
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); //building a new connection object
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //checking which form has been posted
            if (isset($_POST['participant']) && $_POST['participant'] == "1") {
                
            
                $query=$conn->prepare("SELECT * FROM participant INNER JOIN club ON participant.club_id = club.id WHERE participant.firstname LIKE :searchname OR participant.surname LIKE :searchname ;");
                $query->execute([
                    ':searchname' => '%' . $_POST['firstname'] . '%' //$_POST['firstname']
                    ]);

                $results = $query->fetchAll(PDO::FETCH_ASSOC);

                $query1=$conn->prepare("SELECT * FROM interest WHERE firstname LIKE :searchname OR surname LIKE :searchname ;");
                $query1->execute([
                    ':searchname' => '%' . $_POST['firstname'] . '%' //$_POST['firstname']
                    ]);

                $results1 = $query1->fetchAll(PDO::FETCH_ASSOC);

                if (count($results) > 0 || count($results1) > 0) {

                    echo "<h5 class='mb-3'>Participants Found</h5>";

                        foreach ($results as $row) {
                            echo "
                                <div class='result-card'>
                                <div class='title'>{$row['firstname']} {$row['surname']}</div>
                                <div>Email: {$row['email']}</div>
                                <div>Power Output: {$row['power_output']}</div>
                                <div>Distance: {$row['distance']}</div>
                                <div>Club: {$row['name']}</div>
                                </div>
                            ";
                        }
                        foreach ($results1 as $row) {
                            echo "
                                <div class='result-card'>
                                <div class='title'>{$row['firstname']} {$row['surname']}</div>
                                <div>Email: {$row['email']}</div>
                                </div>
                            ";
                        }
                } 

                else {
                    echo "<div class='empty'>No participants found</div>";
                }
            }


            else{
                $query = $conn->prepare("SELECT participant.firstname,participant.surname
                FROM participant JOIN club ON participant.club_id = club.id WHERE club.name LIKE :club");

                $query->execute([
                    ':club' => '%' . $_POST['club'] . '%'
                ]);

                $results = $query->fetchAll(PDO::FETCH_ASSOC);


                $stats = $conn->prepare("SELECT 
                 COUNT(participant.id) AS total_members,
                 SUM(participant.power_output) AS total_power,
                 SUM(participant.distance) AS total_distance,
                 AVG(participant.power_output) AS avg_power,
                 AVG(participant.distance) AS avg_distance,
                 club.name,
                 club.location
                 FROM participant
                 JOIN club ON participant.club_id = club.id
                 WHERE club.name LIKE :club
                ");

                $stats->execute([
                    ':club' => '%' . $_POST['club'] . '%'
                ]);

                $summary = $stats->fetch(PDO::FETCH_ASSOC);


                if (count($results) > 0) {

                    echo "
                        <h5 class='mb-3'>Club Found</h5>
                        <div class='result-card'>
                        <div class='title'>{$summary['name']}</div>
                        <div>Location: {$summary['location']}</div>
                        <div>Total Members: {$summary['total_members']}</div>
                        <div>Total Power Output: {$summary['total_power']}</div>
                        <div>Total Distance: {$summary['total_distance']}</div>
                        <div>Average Power Output: {$summary['avg_power']}</div>
                        <div>Average Distance: {$summary['avg_distance']}</div>

                        <!-- PARTICIPANTS -->
                        <div class='title'>Participants:</div>
                    ";

                    if (count($results) > 0) {
                        foreach ($results as $row) {
                            echo "                                
                               <div>&nbsp;&nbsp;&nbsp;&nbsp;{$row['firstname']} {$row['surname']}  </div>                             
                            ";
                        }
                    }
                } 
                else {
                    echo "<div class='empty'>No clubs found</div>";
                }
            }     
               
        }
        catch(PDOException $e){
            echo $e->getMessage(); //put error stuff here
        }
    ?>
</div>

</body>
</html>