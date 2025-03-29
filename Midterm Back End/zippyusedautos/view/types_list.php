<!DOCTYPE html>
<html>
<head>
    <title>Manage Types - Zippy Used Autos</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <h1>Manage Types</h1>

    <!-- Add Type Form -->
    <form method="post" action="types.php">
        <label for="type_name">Add Type:</label>
        <input type="text" name="type_name" id="type_name">
        <button type="submit" name="action" value="add_type">Add Type</button>
    </form>

    <!-- Display Existing Types -->
    <h2>Existing Types</h2>
    <ul>
        <?php foreach ($types as $type) : ?>
            <li>
                <?= $type['name'] ?>
                <form method="post" action="types.php" style="display:inline;">
                    <input type="hidden" name="type_id" value="<?= $type['id'] ?>">
                    <button type="submit" name="action" value="delete_type">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php include 'footer.php'; ?>
</body>
</html>
