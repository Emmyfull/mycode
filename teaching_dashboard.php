<?php
session_start();
$success = '';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the teaching dashboard form
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $course = $_POST['course'] ?? '';
    $comment = $_POST['comment'] ?? '';
    
    // In a real application, you would save this to a database
    $success = 'Information saved successfully!';
}
?>

<?php include 'header.php'; ?>

<div class="dashboard-container">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <h2>Teaching Dashboard</h2>
    
    <?php if ($success): ?>
        <div class="success-message">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="">
        <div class="form-row">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" required>
            </div>
            
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required>
            </div>
            
            <div class="form-group">
                <label for="course">Course</label>
                <select id="course" name="course" required>
                    <option value="">Select Course</option>
                    <option value="python">Python Programming</option>
                    <option value="cpp">C++ Programming</option>
                    <option value="php">PHP Development</option>
                    <option value="java">Java Programming</option>
                    <option value="javascript">JavaScript</option>
                    <option value="mongodb">MongoDB</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="comment">Comments</label>
            <textarea id="comment" name="comment" rows="4" placeholder="Enter your comments here..."></textarea>
        </div>
        
        <button type="submit" class="btn">Submit Information</button>
    </form>
    
    <div style="margin-top: 2rem; text-align: center;">
        <a href="logout.php" style="color: #dc3545; text-decoration: none;">Logout</a>
    </div>
</div>

<?php include 'footer.php'; ?>