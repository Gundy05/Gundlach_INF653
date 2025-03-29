<!DOCTYPE html>
<html>
<head>
    <title>Manage Classes - Zippy Used Autos</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <h1>Manage Classes</h1>

    <!-- Add Class Form -->
    <form method="post" action="classes.php">
        <label for="class_name">Add Class:</label>
        <input type="text" name="class_name" id="class_name">
        <button type="submit" name="action" value="add_class">Add Class</button>
    </form>

    <!-- Display Existing Classes -->
    <h2>Existing Classes</h2>
    <ul>
        <?php foreach ($classes as $class) : ?>
            <li>
                <?= $class['name'] ?>
                <form method="post" action="classes.php" style="display:inline;">
                    <input type="hidden" name="class_id" value="<?= $class['id'] ?>">
                    <button type="submit" name="action" value="delete_class">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php include 'footer.php'; ?>
</body>
</html>
