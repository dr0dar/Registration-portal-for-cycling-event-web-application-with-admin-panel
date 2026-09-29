<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update participant scores</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
        }

        .top-bar {
            background: #0f172a;
            color: white;
            padding: 15px 20px;
        }

        .back {
            color: white;
            text-decoration: none;
        }

        .form-box {
            max-width: 500px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>
    <!-- Top bar -->
    <div class="top-bar">
        
                <div class="top-bar d-flex align-items-center justify-content-between">
        
                <!-- LEFT: Title -->
                <a href="view_participants_edit_delete.php" class="back">
                    <i class="bi bi-arrow-left"></i>
                </a>

                <div class="dashboard-title mt-2 fw-bold d-flex fs-4 justify-content-center">Edit participant</div>

                <!-- RIGHT: Logout -->
                <a href="." class="btn btn-danger btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>

            </div>
    </div>

    <?php
        include 'dbconnect.php';

        $id = $_GET['id'];

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $conn->prepare("SELECT * FROM participant WHERE id = :id");
            $query->execute([':id' => $id]);

            $row = $query->fetch(PDO::FETCH_ASSOC);

        } 
        catch(PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    ?>
    <div class="form-box">

        <form action="edit_participant.php" method="POST">

            <label class="form-label">Particpant Firstname</label>
            <input type="text" class="form-control mb-3" name="firstname"  disabled value="<?php echo $row['firstname']; ?>" >

            <label class="form-label">Particpant Surname</label>
            <input type="text" class="form-control mb-3" name="surname" disabled value="<?php echo $row['surname']; ?>" >

            <label class="form-label">Power output in watts</label>
            <input type="text" class="form-control mb-3" name="power_output" value="<?php echo $row['power_output']; ?>" require>

            <label class="form-label">Distance in KM</label>
            <input type="text" step="0.1" class="form-control mb-3" name="distance_travelled" value="<?php echo $row['distance']; ?>" require>

            <input type="text" name="id" hidden value="<?php echo $row['id']; ?>" >

            <input class="btn btn-primary w-100" type="submit" value="Update this rider">

        </form>

    </div>

</body>
<script>

if (window.location.search.includes("edit=0")) {
        alert("Unable to edit! Please edit again.");
    }
    
<script>
</html>