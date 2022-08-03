<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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
        <h1 id="modalTitle"></h1>
        <p> <?php GetAppointmentFromASpecificDate(); ?> </p>

        <button id="close">
            Inchide
        </button>
    </div>
</div>
</body>
</html>

<?php
function GetAppointmentFromASpecificDate()
{
    $pdo = new PDO('mysql:dbname=tutorial;host=mysql', 'tutorial', 'secret', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $query = "SELECT * FROM appointments 
    INNER JOIN user ON appointments.user_id = user.id   
    WHERE appointments.reservation = " . "'" . $_GET['date'] . "'";
    $result = $pdo->query($query);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $result->fetch()) {
        echo "Dl/Dna " . $row['first_name'] . " " . $row['last_name'] . "</br>";
    }
}

?>
