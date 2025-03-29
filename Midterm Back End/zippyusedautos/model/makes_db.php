<?php
require_once 'database.php';

function get_all_makes() {
    global $db;
    $query = 'SELECT * FROM makes';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

function add_make($name) {
    global $db;
    $query = 'INSERT INTO makes (name) VALUES (:name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();
}

function delete_make($make_id) {
    global $db;
    $query = 'DELETE FROM makes WHERE id = :make_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':make_id', $make_id);
    $statement->execute();
    $statement->closeCursor();
}
?>
