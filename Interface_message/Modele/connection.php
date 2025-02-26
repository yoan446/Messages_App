<?php
$serverName = "LA-BASE\SQLEXPRESS"; 
$database = "Gestion_Messagerie";


try {
    // Use Trusted_Connection=Yes for Windows Authentication
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?> 