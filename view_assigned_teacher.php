<?php
include('./connection.php');
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$sql = "SELECT users.name AS teacher_name, courses.course_code, courses.course_name, semesters.semester_name,sessions.session_name
        FROM assign_teacher
        JOIN users ON assign_teacher.teacher_id = users.id
        JOIN courses ON assign_teacher.course_code = courses.course_code
        JOIN semesters ON assign_teacher.semester_name = semesters.semester_name
        JOIN sessions ON assign_teacher.session_name = sessions.session_name";
$result = $conn->query($sql);
$assigned_teachers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $assigned_teachers[] = $row;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Assigned Teachers</title>
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

    <div class="container my-4">
        <h1>View Assigned Teachers</h1>

        <?php if (empty($assigned_teachers)) { ?>
            <p>No teachers have been assigned yet.</p>
        <?php } else { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Teacher Name</th>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Semester</th>
                        <th>Session</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($assigned_teachers as $teacher) { ?>
                        <tr>
                            <td><?php echo $teacher['teacher_name']; ?></td>
                            <td><?php echo $teacher['course_code']; ?></td>
                            <td><?php echo $teacher['course_name']; ?></td>
                            <td><?php echo $teacher['semester_name']; ?></td>
                            <td><?php echo $teacher['session_name']; ?></td>
                            <td>
                                <button class="btn-info">Edit</button>
                                <button class="btn-danger">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
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
