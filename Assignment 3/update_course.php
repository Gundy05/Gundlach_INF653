<?php
require_once('database.php');
require_once('course_db.php');

// Retrieve the course details to pre-fill the form
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    $query = 'SELECT * FROM courses WHERE courseID = :course_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id, PDO::PARAM_INT);
    $statement->execute();
    $course = $statement->fetch();
    $statement->closeCursor();
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];

    if (!empty($course_name) && $course_id) {
        update_course($course_id, $course_name);
        header('Location: course_list.php'); // Redirect to course list page
        exit();
    } else {
        $error = "Invalid data. Please check the fields and try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Course</title>
</head>
<body>
    <h1>Update Course</h1>
    
    <?php if (isset($error)) : ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    
    <form action="update_course.php" method="post">
        <!-- Hidden Field for Course ID -->
        <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course['courseID']); ?>">

        <!-- Course Name Input -->
        <label for="course_name">Course Name:</label>
        <input type="text" name="course_name" id="course_name" value="<?php echo htmlspecialchars($course['courseName']); ?>" required>
        <br><br>

        <!-- Submit Button -->
        <button type="submit">Update Course</button>
    </form>
</body>
</html>
