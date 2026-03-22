<?php
/**
 * LESSON 03 - NESTED LOOPS & MULTIDIMENSIONAL ARRAYS
 * 
 * WHAT: This script processes multiple students, each with their own set of subject marks.
 * WHY: To learn how to navigate nested data structures (a loop inside a loop).
 * HOW:
 *  - Outer Loop: Iterates through each Student.
 *  - Inner Loop: Iterates through each Subject for that specific Student.
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. DATA COLLECTION
    // WHAT: Receiving multidimensional arrays.
    // HOW: $_POST['student_names'] is a list of names.
    //      $_POST['marks'] is a nested array where each student index contains 'subjects' and 'scores'.
    $studentNames = $_POST['student_names'];
    $allMarks = $_POST['marks']; // Nested array: [student_index][subjects/scores][item_index]

    $classResults = [];

    // 2. OUTER LOOP: OVER STUDENTS
    // WHAT: Looping through the name list to process each student one by one.
    foreach ($studentNames as $studentIndex => $name) {
        $name = htmlspecialchars($name);
        $studentTotal = 0;
        $subjectResults = [];
        
        // 3. INNER LOOP: OVER SUBJECTS FOR THIS STUDENT
        // WHAT: Looking into the 'marks' array for this specific student's subjects and scores.
        // WHY: Each student has their own unique set of marks.
        $subjects = $allMarks[$studentIndex]['subjects'];
        $scores = $allMarks[$studentIndex]['scores'];

        foreach ($subjects as $markIndex => $subjectName) {
            $score = intval($scores[$markIndex]);
            $grade = "";

            // Standard Grading Logic
            if ($score >= 75) { $grade = "A"; }
            elseif ($score >= 65) { $grade = "B"; }
            elseif ($score >= 55) { $grade = "C"; }
            elseif ($score >= 35) { $grade = "S"; }
            else { $grade = "W"; }

            $studentTotal += $score;
            $subjectResults[] = [
                'subject' => htmlspecialchars($subjectName),
                'score' => $score,
                'grade' => $grade
            ];
        }

        $avg = count($subjects) > 0 ? $studentTotal / count($subjects) : 0;

        // Store entire student record
        $classResults[] = [
            'name' => $name,
            'subjects' => $subjectResults,
            'total' => $studentTotal,
            'average' => round($avg, 2)
        ];
    }

    // 4. DISPLAY CLASSROOM REPORT
    echo "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Classroom Report</title>";
    echo "<style>
            body { font-family: 'Segoe UI', sans-serif; background: #eef2f7; padding: 30px; }
            .report-wrapper { max-width: 900px; margin: auto; }
            .student-card { background: white; margin-bottom: 30px; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
            h2 { color: #1a73e8; margin-top: 0; display: flex; justify-content: space-between; align-items: center; }
            .stats { font-size: 0.9rem; background: #f0f7ff; padding: 10px 15px; border-radius: 8px; color: #1a73e8; }
            table { width: 100%; border-collapse: collapse; margin-top: 15px; }
            th, td { padding: 12px; text-align: left; border-bottom: 1px solid #f0f0f0; }
            th { color: #888; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; }
            .grade { font-weight: bold; padding: 4px 8px; border-radius: 4px; font-size: 0.9rem; }
            .A { background: #e6f4ea; color: #1e7e34; } 
            .B { background: #e7f3ff; color: #0056b3; } 
            .C { background: #fff4e5; color: #b45d00; } 
            .S { background: #fff0f0; color: #d93025; } 
            .W { background: #3c4043; color: white; }
            .back-link { display: block; text-align: center; margin-top: 30px; color: #1a73e8; font-weight: bold; text-decoration: none; }
          </style></head><body>";

    echo "<div class='report-wrapper'>";
    echo "<h1 style='text-align:center;'>Classroom Results Summary</h1>";

    foreach ($classResults as $student) {
        echo "<div class='student-card'>";
        echo "<h2>" . $student['name'] . " <span class='stats'>Total: " . $student['total'] . " | Avg: " . $student['average'] . "</span></h2>";
        
        echo "<table>";
        echo "<tr><th>Subject</th><th>Score</th><th>Grade</th></tr>";
        foreach ($student['subjects'] as $sub) {
            echo "<tr>";
            echo "<td>" . $sub['subject'] . "</td>";
            echo "<td>" . $sub['score'] . "</td>";
            echo "<td><span class='grade " . $sub['grade'] . "'>" . $sub['grade'] . "</span></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    }

    echo "<a href='index.html' class='back-link'>&larr; Back to Input Form</a>";
    echo "</div></body></html>";

} else {
    echo "Access denied.";
}
?>
