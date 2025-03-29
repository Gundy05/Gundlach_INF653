<!DOCTYPE html>
<html>
<head>
    <title>Zippy Used Autos</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <h1>Zippy Used Autos</h1>

    <!-- Filter Form -->
    <form action="." method="get">
        <label for="filter">Filter by:</label>
        <select name="filter_by">
            <option value="make_id">Make</option>
            <option value="type_id">Type</option>
            <option value="class_id">Class</option>
        </select>
        <input type="text" name="filter_value" placeholder="Enter ID">
        <button type="submit" name="action" value="filter">Filter</button>
    </form>

    <!-- Combined Filter Form -->
    <form action="." method="get">
        <label for="make">Make:</label>
        <input type="number" name="make_id" placeholder="Make ID">
        <label for="type">Type:</label>
        <input type="number" name="type_id" placeholder="Type ID">
        <label for="class">Class:</label>
        <input type="number" name="class_id" placeholder="Class ID">
        <button type="submit" name="action" value="combined_filter">Apply Combined Filter</button>
    </form>

    <!-- Sort Form -->
    <form action="." method="get">
        <label for="sort">Sort by:</label>
        <select name="sort_by">
            <option value="price">Price</option>
            <option value="year">Year</option>
        </select>
        <button type="submit" name="action" value="sort">Sort</button>
    </form>

    <!-- Vehicle List -->
    <ul>
        <?php foreach ($vehicles as $vehicle) : ?>
            <li>
                <?= $vehicle['year'] . ' ' . $vehicle['model'] . ' ($' . $vehicle['price'] . ')' ?>
                - Make: <?= $vehicle['make_name'] ?>, Type: <?= $vehicle['type_name'] ?>, Class: <?= $vehicle['class_name'] ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
