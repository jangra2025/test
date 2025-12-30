<?php
include 'db_config.php';

if (!empty($_POST['id'])) {
    $state_id = (int)$_POST['id'];

    $stmt = $DB_con->prepare("SELECT id, city_name FROM city WHERE state_id = ?");
    $stmt->execute([$state_id]);

    echo '<option value="">--Select City--</option>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='{$row['id']}'>{$row['city_name']}</option>";
    }
}
?>
