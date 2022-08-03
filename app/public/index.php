<?php
$pdo = new PDO('mysql:dbname=tutorial;host=mysql', 'tutorial', 'secret', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['first_name'];
    $date = $_GET['date'];
    if (empty($name)) {
        echo "Name is empty";
    } else {
        echo $name;
    }
    $stmt = $pdo->prepare("SELECT id FROM `user` WHERE first_name = :firstName");
    $stmt->bindParam(":firstName", $name);
    $stmt->execute();
    $result = null;
    $result = $stmt->fetch();
    if ($result != null) {
        $stmt = $pdo->prepare("INSERT INTO `appointments`(`location_id`, `user_id`, `reservation`) VALUES ('1',:userId,:dateInput)");
        $stmt->bindParam(":userId", $result['id']);
        $stmt->bindParam(":dateInput", $date);
        $stmt->execute();
    }
}
?>
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

        <?php
        if (GetAppointmentFromASpecificDate())
        {
            echo '<p> Aceasta zi are deja o rezervare!</p>';
        }
        else{
            echo ('<form method="post">
        Name: <input type="text" name="first_name">
        <input type="submit">
        </form>');

        }
        ?>

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
    $rez = $result->fetch();
    $dif = $rez['first_name'] ?? "";
     if ($dif) {

         while ($row = $result->fetch()) {

             echo "Dl/Dna " . $row['first_name'] . " " . $row['last_name'] . "</br>";
         }
         return 1;
     }
     else{
         return 0;
     }
}

?>
