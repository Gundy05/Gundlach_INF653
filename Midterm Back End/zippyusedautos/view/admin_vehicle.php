<!DOCTYPE html>
<html>
<head>
    <title>Manage Vehicles - Zippy Used Autos</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <h1>Manage Vehicles</h1>

    <!-- Add Vehicle Form -->
    <form method="post" action="vehicles.php">
        <label for="year">Year:</label>
        <input type="number" name="year" id="year" required>

        <label for="model">Model:</label>
        <input type="text" name="model" id="model" required>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" required>

        <label for="make_id">Make:</label>
        <select name="make_id" id="make_id" required>
            <?php foreach ($makes as $make) : ?>
                <option value="<?= $make['id'] ?>"><?= $make['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="type_id">Type:</label>
        <select name="type_id" id="type_id" required>
            <?php foreach ($types as $type) : ?>
                <option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="class_id">Class:</label>
        <select name="class_id" id="class_id" required>
            <?php foreach ($classes as $class) : ?>
                <option value="<?= $class['id'] ?>"><?= $class['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" name="action" value="add_vehicle">Add Vehicle</button>
    </form>

    <!-- Existing Vehicles -->
    <h2>Existing Vehicles</h2>
    <ul>
        <?php foreach ($vehicles as $vehicle) : ?>
            <li>
                <?= $vehicle['year'] . ' ' . $vehicle['model'] . ' ($' . $vehicle['price'] . ')' ?>
                - Make: <?= $vehicle['make_name'] ?>, Type: <?= $vehicle['type_name'] ?>, Class: <?= $vehicle['class_name'] ?>
                <form method="post" action="vehicles.php" style="display:inline;">
                    <input type="hidden" name="vehicle_id" value="<?= $vehicle['id'] ?>">
                    <button type="submit" name="action" value="delete_vehicle">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php include 'footer.php'; ?>
</body>
</html>
