<?php
require_once '../model/types_db.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == null) {
    $action = 'list_types';
}

switch ($action) {
    case 'list_types':
        $types = get_all_types();
        include '../view/types_list.php';
        break;

    case 'add_type':
        $type_name = filter_input(INPUT_POST, 'type_name', FILTER_SANITIZE_STRING);
        if ($type_name) {
            add_type($type_name);
        }
        $types = get_all_types();
        include '../view/types_list.php';
        break;

    case 'delete_type':
        $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
        if ($type_id) {
            delete_type($type_id);
        }
        $types = get_all_types();
        include '../view/types_list.php';
        break;
}
?>
