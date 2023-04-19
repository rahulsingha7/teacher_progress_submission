<?php
include('./connection.php');
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'teacher') {
    header('Location: login.php');
    exit;
}
if(isset($_POST['submit'])) {
    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $semester_name = $_POST['semester_name'];
    $session_name = $_POST['session_name'];
    $teacher_id = $_POST['teacher_id'];
    $class_taken=$_POST['class_taken'];
    $ct_taken=$_POST['ct_taken'];
    $assignment_taken= $_POST['assignment_taken'];
    $query = "INSERT INTO progress (course_name, course_code, semester_name,session_name,teacher_id,class_taken,ct_taken,assignment_taken) VALUES ('$course_name', '$course_code', '$semester_name','$session_name', '$teacher_id','$class_taken','$ct_taken','$assignment_taken')";

    if(mysqli_query($conn, $query)) {
        echo "Progress submitted successfully.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Progress</title> 
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
    <h2>Submit Progress</h2>
    <form method="POST">
        <label>Course Name:</label>
        <select name="course_name">
            <?php
            $teacher_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM assign_teacher WHERE teacher_id = $teacher_id";
            $query = "SELECT * FROM courses";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value='".$row['course_name']."'>".$row['course_name']."</option>";
            }
            ?>
        </select>
        <br><br>
        <label>Course Title:</label>
        <select name="course_code">
            <?php
            $teacher_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM assign_teacher WHERE teacher_id = $teacher_id";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value='".$row['course_code']."'>".$row['course_code']."</option>";
            }
            ?>
        </select>
        <br><br>
        <label>Semester:</label>
        <select name="semester_name">
            <?php
               $teacher_id = $_SESSION['user_id'];
               $sql = "SELECT * FROM assign_teacher WHERE teacher_id = $teacher_id";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value='".$row['semester_name']."'>".$row['semester_name']."</option>";
            }
            ?>
        </select>
        <br><br>
        <label>Session:</label>
        <select name="session_name">
            <?php
               $teacher_id = $_SESSION['user_id'];
               $sql = "SELECT * FROM assign_teacher WHERE teacher_id = $teacher_id";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value='".$row['session_name']."'>".$row['session_name']."</option>";
            }
            ?>
        </select>
        <br><br>
        <label>Teacher:</label>
        <select name="teacher_id">
            <?php
              $teacher_id = $_SESSION['user_id'];
              $sql = "SELECT users.id AS teacher_id, users.name AS teacher_name
              FROM assign_teacher
              JOIN users ON assign_teacher.teacher_id = users.id
              WHERE teacher_id = $teacher_id";;
            // $query = "SELECT * FROM users WHERE role='teacher'  ";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value='".$row['teacher_id']."'>".$row['teacher_name']."</option>";
            }
            ?>
        </select>
        <br><br>
        <label>Class Taken: </label>
        <input type="number" name="class_taken" required><br>
        <label>CT taken: </label>
        <input type="number" name="ct_taken" required><br>
        <label>Assignment taken: </label>
        <input type="number" name="assignment_taken" required><br>
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

