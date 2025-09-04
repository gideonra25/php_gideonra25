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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hobi</title>
    <style>
        table { border-collapse: collapse; width: 50%; margin-top: 10px;}
        th, td { border: 1px solid #333; padding: 8px; text-align: left;}
        th { background-color: #f2f2f2; }
        form { margin-bottom: 15px; }
    </style>
</head>
<body>
    <h1>Laporan Jumlah Orang per Hobi</h1>

    <!-- Form search -->
    <form method="get" action="">
        <label>Cari Hobi: </label>
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
        <a href="soal2a.php">Reset</a>
    </form>

    <table>
        <thead>
            <tr>
                <th>Hobi</th>
                <th>Jumlah Person</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['hobi']) ?></td>
                        <td><?= $row['jumlah_person'] ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="2">Tidak ada data</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php

$stmt->close();
$conn->close();

?>