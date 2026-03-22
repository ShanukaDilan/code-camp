<?php
/**
 * LESSON 04 - MODULAR BACKEND
 * 
 * WHAT: The processing script.
 * WHY: To demonstrate how to use external functions.
 * HOW:
 * - include 'functions.php': Imports all logic from the other file.
 * - Calling custom functions like getLetterGrade() instead of writing if-else here.
 */

// 1. STEP: INCLUDE THE FUNCTIONS FILE
// WHAT: The 'include' statement.
// WHY: To access the reusable functions we wrote in functions.php.
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. DATA COLLECTION
    $names = $_POST['names'];
    $allMarks = $_POST['marks']; // Comes from the dynamic inputs: [student_index][subjects/scores][item_index]

    echo "<!DOCTYPE html><html><head><title>Results</title><style>
            body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; padding: 40px; }
            .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); max-width: 500px; margin: 0 auto 20px; border-left: 6px solid #007bff; }
            .grade-badge { font-weight: bold; padding: 2px 6px; border-radius: 3px; color: white; }
          </style></head><body>";
    echo "<h1 style='text-align:center;'>Class Result Summary</h1>";

// 2. STEP: PROCESSING DATA WITH A CUSTOM FUNCTION
    foreach ($names as $index => $name) {
        $subjects = $allMarks[$index]['subjects'];
        $scores = $allMarks[$index]['scores'];

        // WHAT: Calling our high-level function.
        // WHY: Look how simple the loop becomes! All calculations happen inside the function.
        // HOW: results is an array containing: name, results[], total, and average.
        $studentResult = processStudentMarks($name, $subjects, $scores);

        echo "<div class='card'>";
        echo "<h3>" . $studentResult['name'] . "</h3>";
        echo "<p>Total Score: <strong>" . $studentResult['total'] . "</strong> | Average: <strong>" . $studentResult['average'] . "</strong></p>";
        
        echo "<div><strong>Grades: </strong>";
        foreach ($studentResult['results'] as $res) {
            echo "<span class='grade-badge' style='background:" . $res['color'] . "'>" . $res['subject'] . ": " . $res['grade'] . "</span> ";
        }
        echo "</div></div>";
    }

    echo "<p style='text-align:center;'><a href='index.html'>&larr; Back to Form</a></p>";
    echo "</body></html>";

} else {
    echo "Denied.";
}
?>
