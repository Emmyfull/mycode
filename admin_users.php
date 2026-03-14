<?php
session_start();
require_once 'config.php';

// Check if user is admin
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: index.php');
    exit();
}

$message = '';
$error = '';

// Handle Add/Edit operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if ($username && $password) {
                $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                if ($stmt->execute([$username, $password])) {
                    $message = 'User added successfully!';
                } else {
                    $error = 'Failed to add user.';
                }
            }
        } elseif ($_POST['action'] == 'edit') {
            $id = $_POST['id'] ?? 0;
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if ($password) {
                $stmt = $pdo->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
                if ($stmt->execute([$username, $password, $id])) {
                    $message = 'User updated successfully!';
                }
            } else {
                $stmt = $pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
                if ($stmt->execute([$username, $id])) {
                    $message = 'User updated successfully!';
                }
            }
        }
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    // Don't allow deleting admin
    $stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();
    
    if ($user && $user['username'] !== 'admin') {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        if ($stmt->execute([$id])) {
            $message = 'User deleted successfully!';
        }
    } else {
        $error = 'Cannot delete admin user!';
    }
}

// Fetch all users
$stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>

<div class="container my-5">
    <div class="row mb-4">
        <div class="col">
            <h2><i class="fas fa-users"></i> Manage Users</h2>
            <a href="admin_dashboard.php" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>
    
    <?php if ($message): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php if ($error): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?php echo $error; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <!-- Add User Form -->
    <?php if (isset($_GET['action']) && $_GET['action'] == 'add'): ?>
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Add New User</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" required>
                        <div class="form-text">Plain text password</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add User</button>
                    <a href="admin_users.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- Edit User Form -->
    <?php if (isset($_GET['edit'])): 
        $id = (int)$_GET['edit'];
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        if ($user):
    ?>
        <div class="card mb-4">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0">Edit User: <?php echo htmlspecialchars($user['username']); ?></h5>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" 
                               value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password (leave blank to keep current)</label>
                        <input type="text" class="form-control" id="password" name="password">
                        <div class="form-text">Current password: <?php echo $user['password']; ?></div>
                    </div>
                    <button type="submit" class="btn btn-warning">Update User</button>
                    <a href="admin_users.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    <?php 
        endif;
    endif; 
    ?>
    
    <!-- Users Table -->
    <div class="card">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Users List</h5>
            <a href="?action=add" class="btn btn-light btn-sm">
                <i class="fas fa-plus"></i> Add New User
            </a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="usersTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password (Plain)</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td>
                                <?php echo htmlspecialchars($user['username']); ?>
                                <?php if ($user['username'] == 'admin'): ?>
                                    <span class="badge bg-danger">Admin</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($user['password']); ?></td>
                            <td><?php echo $user['created_at']; ?></td>
                            <td>
                                <a href="?edit=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <?php if ($user['username'] != 'admin'): ?>
                                    <a href="?delete=<?php echo $user['id']; ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Are you sure you want to delete this user?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- DataTables Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable();
    });
</script>

<?php include 'footer.php'; ?>