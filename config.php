<?php
try {
    $con = new PDO("sqlsrv:server = finalcloud.database.windows.net; Database = Final", "Cloud", "Fire@008");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
?>
