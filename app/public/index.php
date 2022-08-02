<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script defer src="script.js"></script>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="calendar-content">
    <div class="calendar-header">
        <button id="prev"><</button>
        <h2><span id="months"> </span><span id="years"> </span></h2>
        <button id="next">></button>
    </div>

    <div id="calendar-content" id="">

    </div>
</div>

<div class="modal-container"
     id="modal_container">
    <div class="modal">
        <h1 id="modalTitle">Date:   </h1>
        <p> <?php GetAccounts("Rares"); ?> </p>


        <button id="close">
    Inchide
        </button>
    </div>
</div>
</body>
</html>

<?php
function GetAccounts($first_name){
    $pdo = new PDO('mysql:dbname=tutorial;host=mysql', 'tutorial', 'secret', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $stmt = $pdo->prepare("SELECT * FROM user 
         where user.first_name = :user_first_name");
    $stmt->bindParam(':user_first_name',  $first_name);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $row=$stmt->fetch();
    $row["first_name"];
    echo $row["first_name"];
}

?>
