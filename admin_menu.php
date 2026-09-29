<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin menu</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f1f5f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .top-bar {
            background: #0f172a;
            color: white;
            padding: 15px 20px;
        }

        .dashboard-title {
            font-size: 22px;
            font-weight: 700;
        }

        .container-box {
            max-width: 900px;
            margin: 50px auto;
            padding: 0 15px;
        }

        .card-menu {
            transition: 0.3s;
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .card-menu:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .card-link {
            text-decoration: none;
            color: #0f172a;
            font-weight: 500;
        }

        .card-link:hover {
            color: #0d6efd;
        }

        .icon-box {
            font-size: 28px;
            color: #0d6efd;
        }
    </style>
</head>

<body>

<!-- Top header -->
<div class="top-bar">
        
    <div class="top-bar d-flex align-items-center justify-content-between">
    
        <!-- LEFT: Title -->
        <div class="dashboard-title ">Cit-E Cycling web portal</div>

        <!-- RIGHT: Logout -->
        <a href="." class="btn btn-danger btn-sm">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>

    </div>
</div>

<div class="container-box">

    <div class="row g-4">

        <!-- KEEPING ORIGINAL FUNCTIONALITY -->
        <div class="col-md-6">
            <a href="search_form.php" class="card-link">
                <div class="card card-menu p-4 text-center">
                    <div class="icon-box mb-2">
                        <i class="bi bi-search"></i>
                    </div>
                    Search for clubs or participants
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="view_participants_edit_delete.php" class="card-link">
                <div class="card card-menu p-4 text-center">
                    <div class="icon-box mb-2">
                        <i class="bi bi-people"></i>
                    </div>
                    View all participants to either edit or delete
                </div>
             </a>
        </div>

    </div>

</div>

</body>
</html>
