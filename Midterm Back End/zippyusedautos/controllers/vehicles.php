<?php
// Correct pathing to required files
require_once '../model/vehicles_db.php'; // Ensure this matches your folder structure
require_once '../model/makes_db.php';
require_once '../model/types_db.php';
require_once '../model/classes_db.php';

// Default action to list vehicles
$action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
if ($action === null || $action === false) {
    $action = 'list_vehicles';
}

switch ($action) {
    case 'list_vehicles':
        $vehicles = get_all_vehicles(); // Ensure this function exists and is properly defined
        include '../view/vehicles_list.php';
        break;

    case 'filter':
        $filter_by = filter_input(INPUT_GET, 'filter_by', FILTER_DEFAULT);
        $filter_value = filter_input(INPUT_GET, 'filter_value', FILTER_DEFAULT);
        if ($filter_by && $filter_value) {
            $vehicles = get_vehicles_by_filter($filter_by, $filter_value); // Ensure this function exists
        } else {
            $vehicles = [];
        }
        include '../view/vehicles_list.php';
        break;

    case 'combined_filter':
        $make_id = filter_input(INPUT_GET, 'make_id', FILTER_VALIDATE_INT);
        $type_id = filter_input(INPUT_GET, 'type_id', FILTER_VALIDATE_INT);
        $class_id = filter_input(INPUT_GET, 'class_id', FILTER_VALIDATE_INT);
        if ($make_id && $type_id && $class_id) {
            $vehicles = get_vehicles_combined_filter($make_id, $type_id, $class_id); // Ensure this function exists
        } else {
            $vehicles = [];
        }
        include '../view/vehicles_list.php';
        break;

    case 'sort':
        $sort_by = filter_input(INPUT_GET, 'sort_by', FILTER_DEFAULT);
        if ($sort_by) {
            $vehicles = get_vehicles_sorted($sort_by); // Ensure this function exists
        } else {
            $vehicles = [];
        }
        include '../view/vehicles_list.php';
        break;

    default:
        $vehicles = get_all_vehicles();
        include '../view/vehicles_list.php';
}
?>
