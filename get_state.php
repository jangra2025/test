<?php
include 'db_config.php'; // or paste the PDO connection code here

if (!empty($_POST['id'])) {
    $country_id = (int)$_POST['id'];

    $stmt = $DB_con->prepare("SELECT id, state_name FROM state WHERE country_id = ?");
    $stmt->execute([$country_id]);

    echo '<option value="">--Select State--</option>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='{$row['id']}'>{$row['state_name']}</option>";
    }
}
?>
