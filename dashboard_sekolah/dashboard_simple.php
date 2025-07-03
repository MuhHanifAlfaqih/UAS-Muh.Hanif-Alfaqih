
<?php
require_once 'check_auth.php';
require_once 'config/database.php';

echo "Testing database connection...<br>";

// Test simple queries
$test_queries = [
    'guru' => "SELECT COUNT(*) as total FROM guru",
    'pengumuman' => "SELECT COUNT(*) as total FROM pengumuman", 
    'artikel' => "SELECT COUNT(*) as total FROM artikel",
    'gallery' => "SELECT COUNT(*) as total FROM gallery",
    'ekstrakurikuler' => "SELECT COUNT(*) as total FROM ekstrakurikuler"
];

foreach($test_queries as $table => $query) {
    echo "Testing $table table: ";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $row = mysqli_fetch_array($result);
        echo "OK - Count: " . $row['total'] . "<br>";
    } else {
        echo "ERROR - " . mysqli_error($conn) . "<br>";
    }
}

echo "<br>All tests completed. If no errors above, database is working.";
?>