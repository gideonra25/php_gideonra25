<?php

// connect db
$host = "localhost";
$user = "root";
$pass = "";
$db   = "testdb";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// get search value
$search = isset($_GET['search']) ? $_GET['search'] : '';

// query
$sql = "
    SELECT hobi, COUNT(DISTINCT person_id) AS jumlah_person
    FROM hobi
    WHERE hobi LIKE ?
    GROUP BY hobi
    ORDER BY jumlah_person DESC
";
$stmt = $conn->prepare($sql);
$searchParam = "%$search%";
$stmt->bind_param("s", $searchParam);
$stmt->execute();
$result = $stmt->get_result();



?>