<?php
/**
 * LESSON 01 - PHP BACKEND PROCESSING
 * 
 * WHAT: This script handles the grading logic after the student submits the form.
 * WHY: To perform calculations on the server side and dynamically display the result.
 * HOW: Using PHP superglobals, built-in functions, and conditional 'if-else' statements.
 */

// 1. STEP: SUBMISSION CHECK
// WHAT: Checking the Request Method.
// WHY: To ensure the script only runs when someone submits the form, not just by visiting the URL.
// HOW: Using $_SERVER["REQUEST_METHOD"] to detect "POST".
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. STEP: DATA COLLECTION & SECURITY
    // WHAT: Sanitizing input data.
    // WHY: Security! To prevent "XSS" (Cross-Site Scripting) attacks where people inject malicious code.
    // HOW:
    // - htmlspecialchars(): Converts special characters into HTML entities (e.g., < becomes &lt;).
    // - intval(): Forces the mark to be an integer (a whole number).
    $name = htmlspecialchars($_POST['student_name']);
    $subject = htmlspecialchars($_POST['subject']);
    $mark = intval($_POST['mark']);
    $grade = "";

    // 3. STEP: GRADING LOGIC
    // WHAT: Calculating the Grade based on the mark.
    // WHY: To automate the grading process for the user.
    // HOW: Using 'if', 'elseif', and 'else' statements to check number ranges.
    if ($mark >= 0 && $mark <= 100) {
        if ($mark >= 75) {
            $grade = "A (Distinction)";
        } elseif ($mark >= 65) {
            $grade = "B (Very Good)";
        } elseif ($mark >= 55) {
            $grade = "C (Credit)";
        } elseif ($mark >= 35) {
            $grade = "S (Simple Pass)";
        } else {
            $grade = "W (Weak/Fail)";
        }
    } else {
        // Validation for numbers outside 0-100 range
        $grade = "Invalid Mark (Must be between 0 and 100)";
    }

    // 4. STEP: OUTPUT RESULTS
    // WHAT: Displaying the dynamic response.
    // WHY: To show the user their calculated grade.
    // HOW: Echoing HTML code directly from PHP back to the browser.
    echo "<div style='font-family: \"Segoe UI\", Tahoma, sans-serif; max-width: 400px; margin: 50px auto; padding: 25px; background: #ffffff; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-left: 5px solid #28a745;'>";
    echo "<h2 style='color: #333; margin-top: 0;'>Results Summary</h2>";
    echo "<hr style='border: 0; border-top: 1px solid #eee; margin-bottom: 15px;'>";
    echo "<p><strong>Student Name:</strong> " . $name . "</p>";
    echo "<p><strong>Subject:</strong> " . $subject . "</p>";
    echo "<p><strong>Mark:</strong> " . $mark . "</p>";
    echo "<p><strong>Grade:</strong> <span style='color: #28a745; font-size: 1.3em; font-weight: bold;'>" . $grade . "</span></p>";
    echo "<br><a href='index.html' style='text-decoration: none; color: #007bff; font-weight: bold;'>&larr; Try Another Mark</a>";
    echo "</div>";

} else {
    // SECURITY: If someone tries to access this file without POSTing data
    echo "<p style='color: red; text-align: center;'><strong>Error:</strong> Access Denied. Please submit the form first.</p>";
}
?>
