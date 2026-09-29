
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View participants</title>

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

        .back {
            color: white;
            text-decoration: none;
        }
        .edit{
            
        }
    </style>
</head>
<body>
    <!-- Top bar -->
    <div class="top-bar">
        
                <div class="top-bar d-flex align-items-center justify-content-between">
        
                <!-- LEFT: Title -->
                <a href="admin_menu.php" class="back">
                    <i class="bi bi-arrow-left"></i>
                </a>

                <div class="dashboard-title mt-2 fw-bold d-flex fs-4 justify-content-center">View all of the participants for edit or delete</div>

                <!-- RIGHT: Logout -->
                <a href="." class="btn btn-danger btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>

            </div>
    </div>

<div class="container-box">

    <?php
        
    //including connection variables - remember to update these if you are using XAMPP    
    include 'dbconnect.php';
        
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); //building a new connection object
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $query=$conn->prepare("SELECT * FROM participant");
            $query->execute([]);

            $results = $query->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                echo "<h5 class='mb-3'>Participants Found</h5>";
                $i=1;
                    foreach ($results as $row) {
                        echo "
                            <div class='result-card'>
                            <p>
                            <div class='title'>$i. {$row['firstname']} {$row['surname']}</div>
                            <div>Email: {$row['email']}</div>
                            <div>Power Output: {$row['power_output']}</div>
                            <div>Distance: {$row['distance']}</div>
                            
                            </p>
                           <a href='edit_participant_form.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary me-2 '>Edit</a>
                            <a href='delete.php?id=" . $row['id'] . "' 
                                onclick=\"return confirm('Are you sure?')\" class='btn btn-sm btn-danger '>Delete</a>
                            </div>";
                            $i++;
                    }
                } 
                else {
                    echo "<div class='empty'>No participants found</div>";
                }
            
            }
        catch(PDOException $e)
            {
            echo $e->getMessage(); //If we are not successful we will see an error
            }
        ?>

</body>
<script>

    if (window.location.search.includes("delete=1")) {
        alert("Successful Deleted!");
    }
    if (window.location.search.includes("delete=0")) {
        alert("Unable to delete! Please delete again.");
    }   

</script>
</html>


