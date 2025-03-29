<?php
// Include required files for accessing the database models
require_once '../model/vehicles_db.php';
require_once '../model/makes_db.php';
require_once '../model/types_db.php';
require_once '../model/classes_db.php';

// Set a default action
$action = filter_input(INPUT_POST, 'action', FILTER_DEFAULT);
if ($action === null || $action === false) {
    $action = 'list_vehicles';
}

switch ($action) {
    case 'list_vehicles':
        // Retrieve vehicles and supporting data for display
        $vehicles = get_all_vehicles();
        $makes = get_all_makes();
        $types = get_all_types();
        $classes = get_all_classes();
        include '../view/admin_vehicles_list.php';
        break;

    case 'add_vehicle':
        // Get input data from the form
        $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
        $model = filter_input(INPUT_POST, 'model', FILTER_DEFAULT);
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
        $class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
        $make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);

        // Add the new vehicle if all required inputs are valid
        if ($year && $model && $price && $type_id && $class_id && $make_id) {
            add_vehicle($year, $model, $price, $type_id, $class_id, $make_id);
        }
        // Reload updated data
        $vehicles = get_all_vehicles();
        $makes = get_all_makes();
        $types = get_all_types();
        $classes = get_all_classes();
        include '../view/admin_vehicles_list.php';
        break;

    case 'delete_vehicle':
        // Get the vehicle ID to delete
        $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_VALIDATE_INT);
        if ($vehicle_id) {
            delete_vehicle($vehicle_id);
        }
        // Reload updated data
        $vehicles = get_all_vehicles();
        $makes = get_all_makes();
        $types = get_all_types();
        $classes = get_all_classes();
        include '../view/admin_vehicles_list.php';
        break;
}
?>
