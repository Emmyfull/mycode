<?php
session_start();
require_once 'config.php';

// Fetch all lessons from database
$stmt = $pdo->query("SELECT * FROM lessons ORDER BY created_at DESC");
$lessons = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>

<div class="hero-section">
    <div class="container">
        <h1 class="display-4">Welcome to TechLearning Hub</h1>
        <p class="lead">Your gateway to mastering programming languages and technologies</p>
    </div>
</div>

<div class="container my-5">
    <h2 class="text-center mb-4">Available Lessons</h2>
    
    <?php if (empty($lessons)): ?>
        <div class="alert alert-info text-center">
            No lessons available at the moment.
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($lessons as $lesson): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo $lesson['thumbnail']; ?>" class="card-img-top" alt="<?php echo $lesson['title']; ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($lesson['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($lesson['description']); ?></p>
                            <span class="badge bg-primary mb-2"><?php echo $lesson['category']; ?></span>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="watch.php?id=<?php echo $lesson['id']; ?>" class="btn btn-primary w-100">
                                <i class="fas fa-play-circle"></i> Watch Video
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>