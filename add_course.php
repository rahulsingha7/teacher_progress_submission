<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
include('./connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $query = "INSERT INTO courses (course_name,course_code) VALUES ('$course_name','$course_code')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo 'Course added successfully.';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="add_course.php">Add Course</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_semester.php">Add Semester</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_session.php">Add Session</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="assign_teacher.php">Assign Teacher</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_assigned_teacher.php">View Assigned Teacher</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_progress.php">View Progress</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <h1>Add Course</h1>
    <form method="POST">
        <label>Course Name:</label>
        <input type="text" name="course_name" required><br>
        <label>Course Code:</label>
        <input type="text" name="course_code" required><br>

        <button type="submit">Add Course</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-+Vicv2D+sADu31CjK8pYkV7vAt3fcq3IL5UK5UAPz6j9P6ZASzx3qw0tw6nx0wYd"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+hTtnTjz/a9TQaT6JkYLQo25KTa/8m1pDQowAJlrjqn5C86dKXJQVn3Fk"
        crossorigin="anonymous"></script>
</body>
</html>