<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to load and execute SQL file
function executeSQLFile($conn, $file) {
    $query = file_get_contents($file);
    if ($conn->multi_query($query)) {
        do {
            /* store first result set */
            if ($result = $conn->store_result()) {
                while ($row = $result->fetch_row()) {
                    // Output if needed
                }
                $result->free();
            }
            /* print divider */
            if ($conn->more_results()) {
                // Output if needed
            }
        } while ($conn->next_result());
    } else {
        echo "Error occurred: " . $conn->error;
    }
}

// Execute SQL files
executeSQLFile($conn, 'database.sql');
executeSQLFile($conn, 'structure.sql');
executeSQLFile($conn, 'content.sql');

echo "Installation completed successfully.";

$conn->close();
?>
