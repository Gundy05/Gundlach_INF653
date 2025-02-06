<?php
// Input student's marks
$marks = 85;

// Determine the grade based on the marks
if ($marks >= 90) {
    $grade = "A";
} elseif ($marks >= 80) {
    $grade = "B";
} elseif ($marks >= 70) {
    $grade = "C";
} elseif ($marks >= 60) {
    $grade = "D";
} else {
    $grade = "F";
}

// Output the grade
echo "Input: $marks\n";
echo "Output: You got a $grade!\n";
?>
