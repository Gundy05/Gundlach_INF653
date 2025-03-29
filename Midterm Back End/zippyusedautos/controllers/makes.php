<?php
require_once '../model/makes_db.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == null) {
    $action = 'list_makes';
}

switch ($action) {
    case 'list_makes':
        $makes = get_all_makes();
        include '../view/makes_list.php';
        break;

    case 'add_make':
        $make_name = filter_input(INPUT_POST, 'make_name', FILTER_SANITIZE_STRING);
        if ($make_name) {
            add_make($make_name);
        }
        $makes = get_all_makes();
        include '../view/makes_list.php';
        break;

    case 'delete_make':
        $make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);
        if ($make_id) {
            delete_make($make_id);
        }
        $makes = get_all_makes();
        include '../view/makes_list.php';
        break;
}
?>
