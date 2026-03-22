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
    
    $names = $_POST['names'];
    $marksList = $_POST['marks_list']; // This is an array of strings like "75,80,90"

    echo "<!DOCTYPE html><html><head><title>Results</title><style>
            body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; padding: 40px; }
            .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); max-width: 500px; margin: 0 auto 20px; border-left: 6px solid #007bff; }
            .grade-badge { font-weight: bold; padding: 2px 6px; border-radius: 3px; color: white; }
          </style></head><body>";
    echo "<h1 style='text-align:center;'>Class Result Summary</h1>";

    // 2. STEP: PROCESSING DATA
    foreach ($names as $index => $name) {
        $name = htmlspecialchars($name);
        
        // WHAT: Parsing the comma-separated string into an array.
        // HOW: explode() function splits a string by a delimiter (,).
        $rawMarks = explode(',', $marksList[$index]);
        $marks = array_map('intval', $rawMarks); // Force all to integers

        // 3. STEP: USING OUR FUNCTIONS
        // WHY: Look how clean this is! No more messy loops or if-else blocks here.
        $avg = calculateAverage($marks);

        echo "<div class='card'>";
        echo "<h3>$name</h3>";
        echo "<p>Marks: " . implode(', ', $marks) . "</p>";
        echo "<p><strong>Average Score:</strong> $avg</p>";
        
        echo "<div><strong>Grades: </strong>";
        foreach ($marks as $m) {
            $grade = getLetterGrade($m);
            $color = getGradeColor($grade);
            echo "<span class='grade-badge' style='background:$color'>$grade</span> ";
        }
        echo "</div></div>";
    }

    echo "<p style='text-align:center;'><a href='index.html'>&larr; Back to Form</a></p>";
    echo "</body></html>";

} else {
    echo "Denied.";
}
?>
