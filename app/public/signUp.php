<?php
$pdo = new PDO('mysql:dbname=tutorial;host=mysql', 'tutorial', 'secret', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("INSERT INTO `user`(`first_name`, `last_name`, `email`, `password`) VALUES (:first_name, :last_name, :email, :password)");
    $stmt->bindParam(":first_name", $first_name);
    $stmt->bindParam(":last_name", $last_name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();
    header("Location: /index.php");
}

?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="https://codepen.io/gymratpacks/pen/VKzBEp#0">
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="signUp.css">

</head>
<body>
<div class="row">
    <div class="col-md-12">
        <form method="post">
            <h1> Sign Up </h1>

            <fieldset>

                <label for="first_name">First name:</label>
                <input type="text" id="first_name" name="first_name" required>

                <label for="last_name">Last name:</label>
                <input type="text" id="last_name" name="last_name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

            </fieldset>

            <button type="submit">Sign Up</button>

        </form>
    </div>
</div>

</body>
</html>

