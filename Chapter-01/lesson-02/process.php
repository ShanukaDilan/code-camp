<?php
/**
 * LESSON 02 - ADVANCED PROCESSING WITH ARRAYS
 * 
 * WHAT: This script calculates individual grades, total marks, and average for multiple subjects.
 * WHY: To introduce data iteration (loops) and array handling in PHP.
 * HOW: Using foreach loops to process input arrays and simple arithmetic for totals.
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. DATA COLLECTION
    // WHAT: Receiving values as arrays.
    // WHY: Because our HTML form used name="subjects[]", PHP gives us an array of strings.
    $name = htmlspecialchars($_POST['student_name']);
    $subjects = $_POST['subjects']; // This is an array
    $marks = $_POST['marks'];       // This is an array
    
    $results = []; // WHAT: An empty array to store calculated results.
    $totalMarks = 0;
    
    // 2. LOGIC: LOOPING THROUGH DATA
    // WHAT: A 'foreach' loop.
    // WHY: To process every subject-mark pair without writing redundant code.
    // HOW: We loop through the $subjects array and use its $index to get the corresponding mark.
    foreach ($subjects as $index => $subjectName) {
        $subjectName = htmlspecialchars($subjectName);
        $mark = intval($marks[$index]);
        $grade = "";

        // Grading Logic (Same as Lesson 01)
        if ($mark >= 75) { $grade = "A"; }
        elseif ($mark >= 65) { $grade = "B"; }
        elseif ($mark >= 55) { $grade = "C"; }
        elseif ($mark >= 35) { $grade = "S"; }
        else { $grade = "W"; }

        // Store result for this specific subject
        $results[] = [
            'name' => $subjectName,
            'mark' => $mark,
            'grade' => $grade
        ];

        // Add to total
        $totalMarks += $mark;
    }

    // 3. STATISTICS
    // WHAT: Average calculation.
    // WHY: To provide a summary of student performance.
    // HOW: Total / count of items.
    $subjectCount = count($subjects);
    $average = $subjectCount > 0 ? $totalMarks / $subjectCount : 0;

    // 4. DISPLAY RESULTS
    echo "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Results</title>";
    echo "<style>
            body { font-family: 'Segoe UI', sans-serif; background: #f4f4f9; padding: 40px; }
            .report-card { background: white; max-width: 600px; margin: auto; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
            h2 { color: #1a73e8; border-bottom: 2px solid #eee; padding-bottom: 10px; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
            th { background: #f8f9fa; color: #555; }
            .grade { font-weight: bold; }
            .A { color: #28a745; } .B { color: #17a2b8; } .C { color: #ffc107; } .S { color: #fd7e14; } .W { color: #dc3545; }
            .summary { background: #e8f0fe; padding: 20px; border-radius: 8px; margin-top: 20px; display: flex; justify-content: space-around; }
            .stat-box { text-align: center; }
            .stat-val { font-size: 1.5rem; font-weight: bold; color: #1a73e8; display: block; }
            .back-btn { display: inline-block; margin-top: 20px; text-decoration: none; color: #1a73e8; font-weight: bold; }
          </style></head><body>";

    echo "<div class='report-card'>";
    echo "<h2>Report for " . $name . "</h2>";

    echo "<table>";
    echo "<tr><th>Subject</th><th>Mark</th><th>Grade</th></tr>";
    
    foreach ($results as $res) {
        echo "<tr>";
        echo "<td>" . $res['name'] . "</td>";
        echo "<td>" . $res['mark'] . "</td>";
        echo "<td><span class='grade " . $res['grade'] . "'>" . $res['grade'] . "</span></td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<div class='summary'>";
    echo "<div class='stat-box'><span class='stat-val'>" . $totalMarks . "</span>Total Marks</div>";
    echo "<div class='stat-box'><span class='stat-val'>" . round($average, 2) . "</span>Average</div>";
    echo "</div>";

    echo "<a href='index.html' class='back-btn'>&larr; Create New Report</a>";
    echo "</div></body></html>";

} else {
    echo "Invalid Request.";
}
?>
