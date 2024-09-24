<?php

include '../../config/config.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["load_options"])) {
    $table = mysqli_escape_string($conn, $_POST['table']);
    $value_col = mysqli_escape_string($conn, $_POST['value_col']);
    $display_col = mysqli_escape_string($conn, $_POST['display_col']);
    $conditionString = isset($_POST['condition']) ? $_POST['condition'] : '';

    // Build the SQL query dynamically
    $sql = "SELECT $value_col, $display_col FROM $table";
    
    // Add condition if provided
    if (!empty($conditionString)) {
        // Directly add the condition string (since it's properly formatted)
        $sql .= " WHERE " . $conditionString;
    }

    $result = $conn->query($sql);

    if (!$result) {
        // If query fails, return the error
        echo json_encode(['error' => 'Database error: ' . $conn->error]);
        exit;
    }

    $options = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $options[] = array($value_col => $row[$value_col], $display_col => $row[$display_col]);
        }
    }

    $conn->close();

    // Send JSON response
    echo json_encode($options);
}

?>