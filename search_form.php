<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register your interest</title>

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
            margin: 40px auto;
            padding: 0 15px;
        }

        .search-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            transition: 0.3s;
        }

        .search-card:hover {
            transform: translateY(-3px);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .back-link {
            text-decoration: none;
            color: white;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .back-link:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>

<!-- Top bar -->
<div class="top-bar">
    
            <div class="top-bar d-flex align-items-center justify-content-between">
    
            <!-- LEFT: Title -->
            <a href="admin_menu.php" class="back-link">
                <i class="bi bi-arrow-left"></i>
            </a>

            <div class="dashboard-title mt-2 fw-bold d-flex fs-4 justify-content-center">Search for participants or clubs</div>

            <!-- RIGHT: Logout -->
            <a href="." class="btn btn-danger btn-sm">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>

        </div>
</div>

<div class="container-box">
    <div class="row g-4">

        <!-- Participant Search -->
        <div class="col-md-6">
            <div class="card search-card p-4">
                <div class="section-title">Search for an individual participant</div>

                <form action="search_result.php" method="POST">
                    <label class="form-label">Participant firstname or surname</label>
                    <input type="text" placeholder="Enter firstname or surname" name="firstname" class="form-control" required>
                    <input type="hidden" name="participant" value="1">
                    <button type="submit" class="btn btn-primary w-100 mt-3">
                        Search
                    </button>
                </form>

            </div>
        </div>

        <!-- Club Search -->
        <div class="col-md-6">
            <div class="card search-card p-4">
                <div class="section-title">Search for a club / team</div>

                <form action="search_result.php" method="POST">
                    <label class="form-label">Club name</label>
                    <input type="text" placeholder="Enter club name" name="club" class="form-control" required>
                    <input type="hidden" name="participant" value="0s">
                    <button type="submit" class="btn btn-primary w-100 mt-3">
                        Search
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

</body>
</html>

