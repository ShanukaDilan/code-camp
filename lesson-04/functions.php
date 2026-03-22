<?php
/**
 * LESSON 04 - REUSABLE FUNCTIONS
 * 
 * WHAT: A separate PHP file for utility functions.
 * WHY: To keep the main logic clean and allow multiple files to use the same code.
 * HOW: Defining functions with 'function' keyword and returning values.
 */

/**
 * WHAT: A function to calculate Grade.
 * WHY: Instead of writing 'if-else' every time, we call this single function!
 * @param int $mark The score (0-100)
 * @return string The letter grade
 */
function getLetterGrade($mark) {
    if ($mark >= 75) { return "A"; }
    elseif ($mark >= 65) { return "B"; }
    elseif ($mark >= 55) { return "C"; }
    elseif ($mark >= 35) { return "S"; }
    else { return "W"; }
}

/**
 * WHAT: A function to calculate Average.
 * WHY: Math logic is isolated here, making it easier to update in the future.
 * @param array $marks Array of numbers
 * @return float Calculated average
 */
function calculateAverage($marks) {
    $count = count($marks);
    if ($count === 0) return 0;
    
    $total = array_sum($marks);
    return round($total / $count, 2);
}

/**
 * WHAT: A function to get grade color.
 * WHY: Decoupling visual logic from calculation logic.
 */
function getGradeColor($grade) {
    $colors = [
        "A" => "#28a745",
        "B" => "#17a2b8",
        "C" => "#ffc107",
        "S" => "#fd7e14",
        "W" => "#dc3545"
    ];
    return $colors[$grade] ?? "#333";
}
?>
