<?php
include 'db_config.php';

if (!empty($_POST['id'])) {
    $city_id = (int)$_POST['id'];

    $stmt = $DB_con->prepare("SELECT id, pincode FROM pincode WHERE city_id = ?");
    $stmt->execute([$city_id]);

    echo '<option value="">--Select Pincode--</option>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='{$row['id']}'>{$row['pincode']}</option>";
    }
}
?>
