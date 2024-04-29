<?php
try {
    $con = new PDO("sqlsrv:server = cmproj.database.windows.net; Database = cmproject", "cmpro", "Cloud@007");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
?>
