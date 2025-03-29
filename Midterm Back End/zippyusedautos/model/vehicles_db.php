<?php
require_once 'database.php';

// Fetch all vehicles from the database with related data (make, type, class)
function get_all_vehicles() {
    global $db;
    $query = 'SELECT vehicles.*, makes.name AS make_name, types.name AS type_name, classes.name AS class_name
              FROM vehicles
              JOIN makes ON vehicles.make_id = makes.id
              JOIN types ON vehicles.type_id = types.id
              JOIN classes ON vehicles.class_id = classes.id
              ORDER BY price DESC';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}

// Add a new vehicle to the database
function add_vehicle($year, $model, $price, $type_id, $class_id, $make_id) {
    global $db;
    $query = 'INSERT INTO vehicles (year, model, price, type_id, class_id, make_id)
              VALUES (:year, :model, :price, :type_id, :class_id, :make_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':year', $year);
    $statement->bindValue(':model', $model);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':type_id', $type_id);
    $statement->bindValue(':class_id', $class_id);
    $statement->bindValue(':make_id', $make_id);
    $statement->execute();
    $statement->closeCursor();
}

// Delete a vehicle by its ID
function delete_vehicle($vehicle_id) {
    global $db;
    $query = 'DELETE FROM vehicles WHERE id = :vehicle_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':vehicle_id', $vehicle_id);
    $statement->execute();
    $statement->closeCursor();
}

// Filter vehicles by a single criterion (e.g., make, type, class)
function get_vehicles_by_filter($filter_by, $filter_value) {
    global $db;
    $query = "SELECT vehicles.*, makes.name AS make_name, types.name AS type_name, classes.name AS class_name
              FROM vehicles
              JOIN makes ON vehicles.make_id = makes.id
              JOIN types ON vehicles.type_id = types.id
              JOIN classes ON vehicles.class_id = classes.id
              WHERE $filter_by = :filter_value
              ORDER BY price DESC";
    $statement = $db->prepare($query);
    $statement->bindValue(':filter_value', $filter_value);
    $statement->execute();
    return $statement->fetchAll();
}

// Filter vehicles by multiple criteria (make, type, class)
function get_vehicles_combined_filter($make_id, $type_id, $class_id) {
    global $db;
    $query = 'SELECT vehicles.*, makes.name AS make_name, types.name AS type_name, classes.name AS class_name
              FROM vehicles
              JOIN makes ON vehicles.make_id = makes.id
              JOIN types ON vehicles.type_id = types.id
              JOIN classes ON vehicles.class_id = classes.id
              WHERE vehicles.make_id = :make_id AND vehicles.type_id = :type_id AND vehicles.class_id = :class_id
              ORDER BY price DESC';
    $statement = $db->prepare($query);
    $statement->bindValue(':make_id', $make_id);
    $statement->bindValue(':type_id', $type_id);
    $statement->bindValue(':class_id', $class_id);
    $statement->execute();
    return $statement->fetchAll();
}

// Sort vehicles by year or price
function get_vehicles_sorted($sort_by) {
    global $db;
    if ($sort_by === 'year') {
        $query = 'SELECT vehicles.*, makes.name AS make_name, types.name AS type_name, classes.name AS class_name
                  FROM vehicles
                  JOIN makes ON vehicles.make_id = makes.id
                  JOIN types ON vehicles.type_id = types.id
                  JOIN classes ON vehicles.class_id = classes.id
                  ORDER BY vehicles.year DESC';
    } else {
        $query = 'SELECT vehicles.*, makes.name AS make_name, types.name AS type_name, classes.name AS class_name
                  FROM vehicles
                  JOIN makes ON vehicles.make_id = makes.id
                  JOIN types ON vehicles.type_id = types.id
                  JOIN classes ON vehicles.class_id = classes.id
                  ORDER BY vehicles.price DESC';
    }
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
}
?>
