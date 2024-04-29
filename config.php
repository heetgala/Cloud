<?php
try {
    $con = new PDO("sqlsrv:server = cmpro.database.windows.net; Database = cmproject", "Cloud", "cmpro@008");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
?>
