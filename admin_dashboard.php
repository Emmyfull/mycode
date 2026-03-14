<?php
session_start();
require_once 'config.php';

// Check if user is admin
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// Get statistics
$users_count = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$lessons_count = $pdo->query("SELECT COUNT(*) FROM lessons")->fetchColumn();
?>

<?php include 'header.php'; ?>

<div class="container my-5">
    <div class="row mb-4">
        <div class="col">
            <h2><i class="fas fa-dashboard"></i> Admin Dashboard</h2>
            <p class="text-muted">Welcome back, Admin! Manage your system from here.</p>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Users</h5>
                            <h2 class="display-4"><?php echo $users_count; ?></h2>
                        </div>
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                    <a href="admin_users.php" class="text-white">Manage Users <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Lessons</h5>
                            <h2 class="display-4"><?php echo $lessons_count; ?></h2>
                        </div>
                        <i class="fas fa-book fa-3x"></i>
                    </div>
                    <a href="admin_lessons.php" class="text-white">Manage Lessons <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">System Status</h5>
                            <h4>Active</h4>
                        </div>
                        <i class="fas fa-check-circle fa-3x"></i>
                    </div>
                    <a href="index.php" class="text-white">View Site <i class="fas fa-external-link-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Quick Actions - Users</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="admin_users.php?action=add" class="btn btn-outline-primary">
                            <i class="fas fa-user-plus"></i> Add New User
                        </a>
                        <a href="admin_users.php" class="btn btn-outline-info">
                            <i class="fas fa-edit"></i> Edit/Delete Users
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Quick Actions - Lessons</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="admin_lessons.php?action=add" class="btn btn-outline-primary">
                            <i class="fas fa-plus-circle"></i> Add New Lesson
                        </a>
                        <a href="admin_lessons.php" class="btn btn-outline-info">
                            <i class="fas fa-edit"></i> Edit/Delete Lessons
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>