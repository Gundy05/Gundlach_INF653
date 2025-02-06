<?php
// Input year
$year = 2024;

// Check if the year is a leap year
if (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) {
    echo "Input: $year\n";
    echo "Output: $year is a leap year.\n";
} else {
    echo "Input: $year\n";
    echo "Output: $year is not a leap year.\n";
}
?>
