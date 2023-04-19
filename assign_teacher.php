<?php
include('./connection.php');
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
if(isset($_POST['submit'])) {
    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $semester_name = $_POST['semester_name'];
    $session_name = $_POST['session_name'];
    $teacher_id = $_POST['teacher_id'];
    $query = "INSERT INTO assign_teacher (course_name, course_code, semester_name,session_name,teacher_id) VALUES ('$course_name', '$course_code', '$semester_name','$session_name', '$teacher_id')";
    if(mysqli_query($conn, $query)) {
        echo "Teacher assigned successfully.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Teacher</title> 
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
    <h2>Assign Teacher</h2>
    <form method="POST">
        <label>Course Name:</label>
        <select name="course_name">
            <?php
            $query = "SELECT * FROM courses";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value='".$row['course_name']."'>".$row['course_name']."</option>";
            }
            ?>
        </select>
        <br><br>
        <label>Course Title:</label>
        <select name="course_code">
            <?php
            $query = "SELECT * FROM courses";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value='".$row['course_code']."'>".$row['course_code']."</option>";
            }
            ?>
        </select>
        <br><br>
        <label>Semester:</label>
        <select name="semester_name">
            <?php
            $query = "SELECT * FROM semesters";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value='".$row['semester_name']."'>".$row['semester_name']."</option>";
            }
            ?>
        </select>
        <br><br>
        <label>Session:</label>
        <select name="session_name">
            <?php
            $query = "SELECT * FROM sessions";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value='".$row['session_name']."'>".$row['session_name']."</option>";
            }
            ?>
        </select>
        <br><br>
        <label>Teacher:</label>
        <select name="teacher_id">
            <?php
            $query = "SELECT * FROM users WHERE role='teacher'";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value='".$row['id']."'>".$row['name']."</option>";
            }
            ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Assign">
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

