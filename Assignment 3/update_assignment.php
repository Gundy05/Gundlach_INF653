<?php
require_once('database.php');
require_once('assignment_db.php');
require_once('course_db.php');

// Fetch the current assignment details to pre-fill the form
if (isset($_GET['assignment_id'])) {
    $assignment_id = $_GET['assignment_id'];
    $query = 'SELECT * FROM assignments WHERE ID = :assignment_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':assignment_id', $assignment_id, PDO::PARAM_INT);
    $statement->execute();
    $assignment = $statement->fetch();
    $statement->closeCursor();
}

// Retrieve all courses for the dropdown
$courses = get_courses();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $assignment_id = $_POST['assignment_id'];
    $description = $_POST['description'];
    $course_id = $_POST['course_id'];

    // Call the update function
    update_assignment($assignment_id, $description, $course_id);
    header('Location: assignment_list.php'); // Redirect after updating
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Assignment</title>
</head>
<body>
    <h1>Update Assignment</h1>
    <form action="update_assignment.php" method="post">
        <!-- Hidden Field for Assignment ID -->
        <input type="hidden" name="assignment_id" value="<?php echo htmlspecialchars($assignment['ID']); ?>">

        <!-- Description Input Field -->
        <label for="description">Description:</label>
        <input type="text" name="description" id="description" value="<?php echo htmlspecialchars($assignment['Description']); ?>" required>
        <br><br>

        <!-- Course Dropdown List -->
        <label for="course_id">Course:</label>
        <select name="course_id" id="course_id" required>
            <?php foreach ($courses as $course): ?>
                <option value="<?php echo htmlspecialchars($course['courseID']); ?>" <?php if ($course['courseID'] == $assignment['courseID']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($course['courseName']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <!-- Submit Button -->
        <button type="submit">Update Assignment</button>
    </form>
</body>
</html>
