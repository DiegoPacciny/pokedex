<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pokemon_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM los_entrenadores";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="trainer-card">';
        echo '<div class="trainer-name">' . htmlspecialchars($row["name"]) . '</div>';
        echo '<div class="trainer-age">Edad: ' . htmlspecialchars($row["age"]) . '</div>';
        echo '<div class="trainer-region">Región: ' . htmlspecialchars($row["region"]) . '</div>';
        echo '</div>';
    }
} else {
    echo "No se encontraron entrenadores.";
}

$conn->close();
?>
