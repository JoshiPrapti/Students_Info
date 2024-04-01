<?php
// First validation: Ensure the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $finalGrade = $_POST["finalGrade"];
    $studentName = $_POST["studentName"];
    $studentID = $_POST["studentID"];

    // Check if all the fields are provided
    if (empty($studentName) || empty($studentID) || empty($finalGrade)) {
        echo "All fields are required.";
    } else {
        // Check if student name contains only letters
        if (!preg_match("/^[a-zA-Z]+$/", $studentName)) {
            echo "Error: Student name must contain only letters.";
        } else {
            // Check if student ID is an 8-digit number
            if (!preg_match("/^[0-9]{8}$/", $studentID)) {
                echo "Error: Student ID should be 8 characters long (numeric).";
            } else {
                // Check if grade is within  0 - 100
                if ($finalGrade < 0 || $finalGrade > 100) {
                    echo "Error: Final grade should be between 0 and 100.";
                }
            }
        }
    }

    // Establish database connection
    $conn = new mysqli("localhost", "root", "", "ilac_college");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL query for insertion
    $sql = "INSERT INTO students (student_name, student_id, final_grade) VALUES ('$studentName','$studentID','$finalGrade')";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        // Redirect to view.html after successful insertion
        header('Location: view.html');
        exit; // Terminate script execution after redirect
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>














