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