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
