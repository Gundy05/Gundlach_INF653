<?php
require_once '../model/classes_db.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == null) {
    $action = 'list_classes';
}

switch ($action) {
    case 'list_classes':
        $classes = get_all_classes();
        include '../view/classes_list.php';
        break;

    case 'add_class':
        $class_name = filter_input(INPUT_POST, 'class_name', FILTER_SANITIZE_STRING);
        if ($class_name) {
            add_class($class_name);
        }
        $classes = get_all_classes();
        include '../view/classes_list.php';
        break;

    case 'delete_class':
        $class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
        if ($class_id) {
            delete_class($class_id);
        }
        $classes = get_all_classes();
        include '../view/classes_list.php';
        break;
}
?>
