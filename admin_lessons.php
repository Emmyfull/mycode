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
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $category = $_POST['category'] ?? '';
            $video_url = $_POST['video_url'] ?? '';
            $thumbnail = $_POST['thumbnail'] ?? '';
            
            if ($title && $description && $category && $video_url) {
                $stmt = $pdo->prepare("INSERT INTO lessons (title, description, category, video_url, thumbnail) VALUES (?, ?, ?, ?, ?)");
                if ($stmt->execute([$title, $description, $category, $video_url, $thumbnail])) {
                    $message = 'Lesson added successfully!';
                } else {
                    $error = 'Failed to add lesson.';
                }
            }
        } elseif ($_POST['action'] == 'edit') {
            $id = $_POST['id'] ?? 0;
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $category = $_POST['category'] ?? '';
            $video_url = $_POST['video_url'] ?? '';
            $thumbnail = $_POST['thumbnail'] ?? '';
            
            $stmt = $pdo->prepare("UPDATE lessons SET title = ?, description = ?, category = ?, video_url = ?, thumbnail = ? WHERE id = ?");
            if ($stmt->execute([$title, $description, $category, $video_url, $thumbnail, $id])) {
                $message = 'Lesson updated successfully!';
            }
        }
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM lessons WHERE id = ?");
    if ($stmt->execute([$id])) {
        $message = 'Lesson deleted successfully!';
    }
}

// Fetch all lessons
$stmt = $pdo->query("SELECT * FROM lessons ORDER BY id DESC");
$lessons = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>

<div class="container my-5">
    <div class="row mb-4">
        <div class="col">
            <h2><i class="fas fa-book"></i> Manage Lessons</h2>
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
    
    <!-- Add Lesson Form -->
    <?php if (isset($_GET['action']) && $_GET['action'] == 'add'): ?>
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Add New Lesson</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <input type="hidden" name="action" value="add">
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Python">Python</option>
                            <option value="C++">C++</option>
                            <option value="PHP">PHP</option>
                            <option value="Java">Java</option>
                            <option value="JavaScript">JavaScript</option>
                            <option value="Database">Database</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="video_url" class="form-label">Video URL (YouTube embed URL)</label>
                        <input type="url" class="form-control" id="video_url" name="video_url" 
                               placeholder="https://www.youtube.com/embed/VIDEO_ID" required>
                        <div class="form-text">Use YouTube embed URL format: https://www.youtube.com/embed/VIDEO_ID</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Thumbnail URL</label>
                        <input type="url" class="form-control" id="thumbnail" name="thumbnail" 
                               placeholder="https://img.youtube.com/vi/VIDEO_ID/maxresdefault.jpg">
                        <div class="form-text">YouTube thumbnail: https://img.youtube.com/vi/VIDEO_ID/maxresdefault.jpg</div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Add Lesson</button>
                    <a href="admin_lessons.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- Edit Lesson Form -->
    <?php if (isset($_GET['edit'])): 
        $id = (int)$_GET['edit'];
        $stmt = $pdo->prepare("SELECT * FROM lessons WHERE id = ?");
        $stmt->execute([$id]);
        $lesson = $stmt->fetch();
        if ($lesson):
    ?>
        <div class="card mb-4">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0">Edit Lesson: <?php echo htmlspecialchars($lesson['title']); ?></h5>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?php echo $lesson['id']; ?>">
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="<?php echo htmlspecialchars($lesson['title']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($lesson['description']); ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Python" <?php echo $lesson['category'] == 'Python' ? 'selected' : ''; ?>>Python</option>
                            <option value="C++" <?php echo $lesson['category'] == 'C++' ? 'selected' : ''; ?>>C++</option>
                            <option value="PHP" <?php echo $lesson['category'] == 'PHP' ? 'selected' : ''; ?>>PHP</option>
                            <option value="Java" <?php echo $lesson['category'] == 'Java' ? 'selected' : ''; ?>>Java</option>
                            <option value="JavaScript" <?php echo $lesson['category'] == 'JavaScript' ? 'selected' : ''; ?>>JavaScript</option>
                            <option value="Database" <?php echo $lesson['category'] == 'Database' ? 'selected' : ''; ?>>Database</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="video_url" class="form-label">Video URL</label>
                        <input type="url" class="form-control" id="video_url" name="video_url" 
                               value="<?php echo htmlspecialchars($lesson['video_url']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Thumbnail URL</label>
                        <input type="url" class="form-control" id="thumbnail" name="thumbnail" 
                               value="<?php echo htmlspecialchars($lesson['thumbnail']); ?>">
                    </div>
                    
                    <button type="submit" class="btn btn-warning">Update Lesson</button>
                    <a href="admin_lessons.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    <?php 
        endif;
    endif; 
    ?>
    
    <!-- Lessons Table -->
    <div class="card">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Lessons List</h5>
            <a href="?action=add" class="btn btn-light btn-sm">
                <i class="fas fa-plus"></i> Add New Lesson
            </a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="lessonsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lessons as $lesson): ?>
                        <tr>
                            <td><?php echo $lesson['id']; ?></td>
                            <td>
                                <?php if ($lesson['thumbnail']): ?>
                                    <img src="<?php echo $lesson['thumbnail']; ?>" alt="Thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                <?php else: ?>
                                    No image
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($lesson['title']); ?></td>
                            <td><span class="badge bg-primary"><?php echo $lesson['category']; ?></span></td>
                            <td><?php echo substr(htmlspecialchars($lesson['description']), 0, 50); ?>...</td>
                            <td><?php echo date('Y-m-d', strtotime($lesson['created_at'])); ?></td>
                            <td>
                                <a href="?edit=<?php echo $lesson['id']; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="?delete=<?php echo $lesson['id']; ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Are you sure you want to delete this lesson?')">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
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
        $('#lessonsTable').DataTable();
    });
</script>

<?php include 'footer.php'; ?>