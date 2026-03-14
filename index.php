<<<<<<< HEAD
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
=======
<!DOCTYPE html>
<html>
<head>
    <title>PHP Practice Output</title>
</head>
<body>

<?php

// Basic variables
$name = "TEKEREZA";
$age = 50;
$email = "tekerezae@gmail.com";
$price = 10.99;
$quantity = 10;
$users = 1000;
$gpa = 3.5;
$taxRate = 0.07;

// Calculations
$totalPrice = $price * $quantity;
$taxAmount = $price * $taxRate;
$totalWithTaxSingle = $price + $taxAmount;
$totalWithTaxAll = $totalPrice + ($totalPrice * $taxRate);

// Output

echo "The total price of the order is $" . $totalPrice . "<br>";
echo "This is " . $name . "<br>";
echo "This is my " . $age . " year old<br>";
echo "hello " . $name . "<br>";
echo "I like pizza<br>";
echo "My email is " . $email . "<br>";
echo "My name is $name and I am $age years old.<br>";
echo "The price of the pizza is $" . $price . "<br>";
echo "You are $age years old and your email is $email<br>";
echo "There are $users users and the quantity is $quantity<br>";
echo "The total price is $" . $totalPrice . "<br>";
echo "You would like to order $quantity pizzas and the total price is $" . $totalPrice . "<br>";
echo "Your GPA is $gpa<br>";
echo "Your pizza is $$price<br>";
echo "The tax is 7%<br>";
echo "The total price with tax is $" . $totalWithTaxSingle . "<br>";

// Repeated total for 10 pizzas with tax
for ($i = 0; $i < 4; $i++) {
    echo "The total price for 10 pizzas with tax is $" . $totalWithTaxAll . "<br>";
}

echo "Online status: Offline<br>";
echo "Employment status: Employed<br>";
echo "For sale: Yes<br>";
echo "You have ordered $quantity pizzas and the total price with tax is $" . $totalWithTaxAll . "<br>";
echo "You have ordered $quantity x pizzas<br>";
echo "Your total price with tax is $" . $totalPrice . "<br>";

?>

</body>
</html>
>>>>>>> 505d118bd837bcbf595af0760e9bdf5ff2b7a253
