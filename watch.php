<?php
session_start();
require_once 'config.php';

// Get lesson ID from URL
$lesson_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch lesson details
$stmt = $pdo->prepare("SELECT * FROM lessons WHERE id = ?");
$stmt->execute([$lesson_id]);
$lesson = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$lesson) {
    header('Location: index.php');
    exit();
}
?>

<?php include 'header.php'; ?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <?php if (!isset($_SESSION['username'])): ?>
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-triangle"></i>
                    Please <a href="login.php" class="alert-link">login</a> or 
                    <a href="signup.php" class="alert-link">sign up</a> to watch this video.
                </div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"><?php echo htmlspecialchars($lesson['title']); ?></h2>
                    <p class="text-muted">Category: <?php echo $lesson['category']; ?></p>
                    <p class="card-text"><?php echo htmlspecialchars($lesson['description']); ?></p>
                    
                    <?php if (isset($_SESSION['username'])): ?>
                        <div class="video-container mt-4">
                            <iframe src="<?php echo $lesson['video_url']; ?>" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                            </iframe>
                        </div>
                    <?php else: ?>
                        <div class="text-center p-5 bg-light rounded">
                            <i class="fas fa-lock fa-4x text-muted mb-3"></i>
                            <h4>Video Locked</h4>
                            <p class="text-muted">You need to be logged in to watch this video.</p>
                            <a href="login.php" class="btn btn-primary">Login</a>
                            <a href="signup.php" class="btn btn-outline-primary">Sign Up</a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer">
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Lessons
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>