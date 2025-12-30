<?php
$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "mydb";

try {
    $DB_con = new PDO("mysql:host=$DB_host;dbname=$DB_name;charset=utf8", $DB_user, $DB_pass);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dynamic Dropdown</title>

    <script src="jquery-1.4.1.min.js"></script>

    <script>
        $(document).ready(function() {

            $(".country").change(function() {
                var id = $(this).val();
                $(".state").html('<option>Loading...</option>');
                $(".city").html('<option>--Select City--</option>');
                $(".pincode").html('<option>--Select Pincode--</option>');

                $.post("get_state.php", {
                    id: id
                }, function(data) {
                    $(".state").html(data);
                });
            });

            $(".state").change(function() {
                var id = $(this).val();
                $.post("get_cities.php", {
                    id: id
                }, function(data) {
                    $(".city").html(data);
                });
            });

            $(".city").change(function() {
                var id = $(this).val();
                $.post("get_pincode.php", {
                    id: id
                }, function(data) {
                    $(".pincode").html(data);
                });
            });

        });
    </script>


    <style>
        select {
            width: 200px;
            height: 35px;
        }

        label {
            font-weight: bold;
        }
    </style>
</head>

<body>


    <label>Country:</label>
    <select class="country">
        <option value="">--Select Country--</option>
        <?php
        $stmt = $DB_con->query("SELECT * FROM countries");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$row['id']}'>{$row['country_name']}</option>";
        }
        ?>
    </select>

    <br><br>

    <label>State:</label>
    <select class="state">
        <option>--Select State--</option>
        <?php
        $stmt = $DB_con->query("SELECT * FROM state");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$row['id']}'>{$row['state_name']}</option>";
        }
        ?>
    </select>

    <br><br>

    <label>City:</label>
    <select class="city">
        <option>--Select City--</option>
        <?php
        $stmt = $DB_con->query("SELECT * FROM city");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$row['id']}'>{$row['city_name']}</option>";
        }
        ?>

    </select>
    <br><br>
    <label>Pincode:</label>
    <select class="pincode">
        <option>--Select pincode--</option>
        <?php
        $stmt = $DB_con->query("SELECT * FROM pincode");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$row['id']}'>{$row['pincode']}</option>";
        }
        ?>

    </select>
    <br><br>
    <button type="submit">Submit</button>


</body>

</html>