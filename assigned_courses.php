<?php
include('./connection.php');
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'teacher') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Teacher Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="assigned_courses.php">Assigned Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="submit_progress.php">Submit Progress</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-3">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Semester Name</th>
                    <th>Session Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $teacher_id = $_SESSION['user_id'];
                $sql = "SELECT * FROM assign_teacher WHERE teacher_id = $teacher_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["course_code"] . "</td><td>" . $row["course_name"] . "</td><td>" . $row["semester_name"] . "</td><td>" . $row["session_name"] . "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No courses assigned.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-+Vicv2D+sADu31CjK8pYkV7vAt3fcq3IL5UK5UAPz6j9P6ZASzx3qw0tw6nx0wYd"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+hTtnTjz/a9TQaT6JkYLQo25KTa/8m1pDQowAJlrjqn5C86dKXJQVn3Fk"
        crossorigin="anonymous"></script>
</body>
</html>
