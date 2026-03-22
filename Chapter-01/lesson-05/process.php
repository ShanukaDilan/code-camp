<?php
/**
 * LESSON 05 - CLASSROOM LEADERBOARD
 * 
 * WHAT: This script processes all students and determines their RANK.
 * WHY: To introduce sorting and data comparison.
 * HOW:
 * 1. Calculate each student's results.
 * 2. Pass the list to rankStudents() function.
 * 3. Sort by Average and output a leaderboard.
 */

include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $names = $_POST['names'];
    $allMarks = $_POST['marks'];
    
    $studentTable = [];

    // 1. PROCESS EACH STUDENT
    foreach ($names as $i => $name) {
        $subjects = $allMarks[$i]['s'];
        $scores = $allMarks[$i]['v'];

        // Get basic results (Total and Avg)
        $studentTable[] = processStudentMarks($name, $subjects, $scores);
    }

    // 2. APPLY RANKING
    // WHAT: Passing the array by reference to our sorting function.
    rankStudents($studentTable);

    // 3. DISPLAY LEADERBOARD
    echo "<!DOCTYPE html><html><head><title>Leaderboard</title><style>
        body { font-family: 'Segoe UI', sans-serif; background: #eef2f7; padding: 40px; }
        .leaderboard { background: white; max-width: 700px; margin: auto; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #1a73e8; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 15px; border-bottom: 1px solid #eee; text-align: center; }
        th { background: #1a73e8; color: white; text-transform: uppercase; font-size: 0.8rem; }
        tr:nth-child(even) { background: #fafafa; }
        .rank-1 { background: #ffd700 !important; font-weight: bold; } /* Gold */
        .rank-2 { background: #c0c0c0 !important; font-weight: bold; } /* Silver */
        .rank-3 { background: #cd7f32 !important; font-weight: bold; color: white; } /* Bronze */
        .rank-val { font-size: 1.2rem; display: block; }
        .btn-back { display: block; text-align: center; margin-top: 30px; text-decoration: none; color: #1a73e8; font-weight: bold; }
    </style></head><body>";

    echo "<div class='leaderboard'>";
    echo "<h1>🏆 Classroom Leaderboard</h1>";
    echo "<table>";
    echo "<tr><th>Rank</th><th>Student Name</th><th>Subject Grades</th><th>Total Marks</th><th>Average</th></tr>";

    foreach ($studentTable as $student) {
        $rankClass = ($student['rank'] <= 3) ? "rank-" . $student['rank'] : "";
        
        // WHAT: Displaying subject details.
        // HOW: Looping through the 'details' array for each student.
        $detailsHtml = "";
        foreach ($student['details'] as $d) {
            $detailsHtml .= "<div style='font-size: 0.85rem;'>" . $d['subject'] . ": <strong>" . $d['grade'] . "</strong></div>";
        }

        echo "<tr class='$rankClass'>";
        echo "<td><span class='rank-val'>#" . $student['rank'] . "</span></td>";
        echo "<td>" . $student['name'] . "</td>";
        echo "<td>" . $detailsHtml . "</td>";
        echo "<td>" . $student['total'] . "</td>";
        echo "<td>" . $student['average'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<a href='index.html' class='btn-back'>&larr; Back to Classroom Setup</a>";
    echo "</div></body></html>";

} else {
    echo "Access Denied.";
}
?>
