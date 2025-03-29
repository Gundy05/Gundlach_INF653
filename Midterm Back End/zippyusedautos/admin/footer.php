<footer>
    <nav>
        <ul>
            <li><?= ($_SERVER['SCRIPT_NAME'] != '/admin/makes.php') ? '<a href="makes.php">Manage Makes</a>' : 'Manage Makes' ?></li>
            <li><?= ($_SERVER['SCRIPT_NAME'] != '/admin/types.php') ? '<a href="types.php">Manage Types</a>' : 'Manage Types' ?></li>
            <li><?= ($_SERVER['SCRIPT_NAME'] != '/admin/classes.php') ? '<a href="classes.php">Manage Classes</a>' : 'Manage Classes' ?></li>
            <li><?= ($_SERVER['SCRIPT_NAME'] != '/admin/vehicles.php') ? '<a href="vehicles.php">Manage Vehicles</a>' : 'Manage Vehicles' ?></li>
        </ul>
    </nav>
</footer>
