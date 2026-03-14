<?php

$title = "Open an Account";


$name = "Tekereza Emmanuel";
$age = 22;

if ($age > 20) {
    $message = "Hello $name, your account has been successfully opened!";
} else {
    $message = "Sorry $name, you must be older than 20 to open an account.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>
<body>
    <h1><?php echo $title; ?></h1>
    <p><?php echo $message; ?></p>
</body>
</html>
