<?php
require_once '../model/makes_db.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == 'add_make') {
    $make_name = filter_input(INPUT_POST, 'make_name', FILTER_SANITIZE_STRING);
    if ($make_name) {
        add_make($make_name);
    }
} elseif ($action == 'delete_make') {
    $make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);
    if ($make_id) {
        delete_make($make_id);
    }
}

$makes = get_all_makes();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Makes - Zippy Used Autos</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <h1>Manage Makes</h1>

    <!-- Add Make Form -->
    <form method="post" action="makes.php">
        <label for="make_name">Add Make:</label>
        <input type="text" name="make_name" id="make_name">
        <button type="submit" name="action" value="add_make">Add Make</button>
    </form>

    <!-- Display Existing Makes -->
    <h2>Existing Makes</h2>
    <ul>
        <?php foreach ($makes as $make) : ?>
            <li>
                <?= $make['name'] ?>
                <form method="post" action="makes.php" style="display:inline;">
                    <input type="hidden" name="make_id" value="<?= $make['id'] ?>">
                    <button type="submit" name="action" value="delete_make">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php include 'footer.php'; ?>
</body>
</html>
