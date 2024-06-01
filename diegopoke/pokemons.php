<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pokemon_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT p.id, p.name, p.image, GROUP_CONCAT(t.name) AS types
        FROM los_pokemones p
        LEFT JOIN relacion_pokemons rpt ON p.id = rpt.pokemon_id
        LEFT JOIN type t ON rpt.type_id = t.id";

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql .= " WHERE p.name LIKE '%$search%'";
}

$sql .= " GROUP BY p.id";


$order_by = 'name_asc';

if (isset($_GET['order_by'])) {
    $order_by = $_GET['order_by'];
}

switch ($order_by) {
    case 'name_asc':
        $sql .= " ORDER BY p.name ASC";
        break;
    case 'name_desc':
        $sql .= " ORDER BY p.name DESC";
        break;
    case 'id_asc':
        $sql .= " ORDER BY p.id ASC";
        break;
    case 'id_desc':
        $sql .= " ORDER BY p.id DESC";
        break;
    default:
        $sql .= " ORDER BY p.name ASC";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="pokemon-card">';
        echo '<div class="pokemon-image"><img data-src="' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["name"]) . '"></div>';
        echo '<div class="pokemon-name">' . htmlspecialchars($row["name"]) . '</div>';
        
        $types = explode(',', $row["types"]);
        echo '<div class="pokemon-type">';
        foreach ($types as $type) {
            echo '<div class="' . strtolower(htmlspecialchars($type)) . '-type">' . htmlspecialchars($type) . '</div>';
        }
        echo '</div>';

        echo '<div class="pokemon-id">' . htmlspecialchars($row["id"]) . '</div>';
        echo '</div>';
    }
} else {
    echo "Ese pokemon no existe";
}

$conn->close();
?>