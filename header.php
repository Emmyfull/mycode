<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechLearning Hub</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- DataTables CSS for better tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <style>
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .card {
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .footer {
            background-color: #f8f9fa;
            padding: 3rem 0;
            margin-top: 4rem;
        }
        .admin-badge {
            background-color: #dc3545;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">📚 TechLearning</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>" href="contact.php">Contact</a>
                    </li>
                    
                    <?php if (isset($_SESSION['username'])): ?>
                        <!-- Show Admin Dashboard link only for admin -->
                        <?php if ($_SESSION['username'] == 'admin'): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle <?php echo (basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php' || basename($_SERVER['PHP_SELF']) == 'admin_users.php' || basename($_SERVER['PHP_SELF']) == 'admin_lessons.php') ? 'active' : ''; ?>" 
                                   href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                    Admin Dashboard <span class="admin-badge">Admin</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="admin_dashboard.php"><i class="fas fa-dashboard"></i> Dashboard Home</a></li>
                                    <li><a class="dropdown-item" href="admin_users.php"><i class="fas fa-users"></i> Manage Users</a></li>
                                    <li><a class="dropdown-item" href="admin_lessons.php"><i class="fas fa-book"></i> Manage Lessons</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt"></i> Logout (<?php echo $_SESSION['username']; ?>)
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'signup.php' ? 'active' : ''; ?>" href="signup.php">Sign Up</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <main>