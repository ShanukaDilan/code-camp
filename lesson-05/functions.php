<?php
/**
 * LESSON 05 - SORTING & RANKING
 * 
 * WHAT: Global functions for the Classroom Ranking System.
 * WHY: To calculate individual results AND compare students to determine their rank.
 * HOW: Using PHP's usort() to sort an array of objects/associative arrays.
 */

/**
 * WHAT: Basic grading logic.
 */
function getLetterGrade($mark) {
    if ($mark >= 75) return "A";
    if ($mark >= 65) return "B";
    if ($mark >= 55) return "C";
    if ($mark >= 35) return "S";
    return "W";
}

/**
 * WHAT: Student Result Processor.
 * @return array A student record object.
 */
function processStudentMarks($name, $subjects, $scores) {
    $total = 0;
    $details = [];
    foreach ($scores as $i => $s) { 
        $score = intval($s);
        $total += $score;
        $details[] = [
            'subject' => htmlspecialchars($subjects[$i]),
            'score' => $score,
            'grade' => getLetterGrade($score)
        ];
    }
    $avg = count($subjects) > 0 ? $total / count($subjects) : 0;

    return [
        'name' => htmlspecialchars($name),
        'total' => $total,
        'average' => round($avg, 2),
        'details' => $details
    ];
}

/**
 * WHAT: Ranking Algorithm.
 * WHY: To determine who is first, second, etc. based on their Average.
 * HOW:
 * 1. usort(): Sorts the array based on a custom comparison function.
 * 2. The comparison (b-a) sorts in DESCENDING order (highest first).
 * 3. Loop through the sorted list to assign an index-based rank.
 */
function rankStudents(&$students) {
    // Sort students by average (highest to lowest)
    usort($students, function($a, $b) {
        if ($a['average'] == $b['average']) return 0;
        return ($a['average'] > $b['average']) ? -1 : 1;
    });

    // Assign rank positions
    foreach ($students as $index => &$student) {
        $student['rank'] = $index + 1;
    }
}
?>
