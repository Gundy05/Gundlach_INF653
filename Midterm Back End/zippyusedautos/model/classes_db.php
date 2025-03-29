<?php
require_once 'database.php';

function get_all_classes() {
    global $db;
    $query = 'SELECT * FROM classes';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

function add_class($name) {
    global $db;
    $query = 'INSERT INTO classes (name) VALUES (:name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();
}

function delete_class($class_id) {
    global $db;
    $query = 'DELETE FROM classes WHERE id = :class_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':class_id', $class_id);
    $statement->execute();
    $statement->closeCursor();
}
?>
