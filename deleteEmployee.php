<?php
// import database configurations
include "config/database.php"
?>

<?php
$method = $_SERVER["REQUEST_METHOD"];

if ($method === "DELETE") {
    $id = json_decode(file_get_contents("php://input"), true)["id"];
    $sql = "DELETE FROM employees WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode("ok");
    } else {
        throw "fail";
    }
}

?>