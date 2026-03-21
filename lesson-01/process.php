<?php
// Check if the form was actually submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Collect and sanitize input data
    $name = htmlspecialchars($_POST['student_name']);
    $subject = htmlspecialchars($_POST['subject']);
    $mark = intval($_POST['mark']);
    $grade = "";

    // Validation and Grading Logic
    if ($mark >= 0 && $mark <= 100) {
        if ($mark >= 75) {
            $grade = "A";
        } elseif ($mark >= 65) {
            $grade = "B";
        } elseif ($mark >= 55) {
            $grade = "C";
        } elseif ($mark >= 35) {
            $grade = "S";
        } else {
            $grade = "W";
        }
    } else {
        $grade = "Invalid Mark (Must be between 0 and 100)";
    }

    // Output the results
    echo "<div style='font-family: Arial; max-width: 400px; margin: 50px auto; padding: 20px; background: #e9ecef; border-radius: 8px;'>";
    echo "<h2>Results</h2>";
    echo "<p><strong>Student Name:</strong> " . $name . "</p>";
    echo "<p><strong>Subject:</strong> " . $subject . "</p>";
    echo "<p><strong>Mark:</strong> " . $mark . "</p>";
    echo "<p><strong>Grade:</strong> <span style='color: #d9534f; font-size: 1.2em; font-weight: bold;'>" . $grade . "</span></p>";
    echo "<br><a href='index.html' style='text-decoration: none; color: #007bff;'>&larr; Go Back</a>";
    echo "</div>";

} else {
    // If someone tries to access process.php directly without submitting the form
    echo "Error: Please submit the form first.";
}
?>
