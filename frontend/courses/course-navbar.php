<div class="course-navbar">
    <div class="left-align link-container">
        <a href="home.php" class="link text">Home</a>
    </div>
    <!-- FOR TEACHERS ONLY -->
    <?php if($_SESSION['role'] == "TEACHER")
    echo'
    <div class="left-align link-container">
        <a href="students.php" class="link text">Students</a>
    </div>
    '?>
    <div class="left-align link-container">
        <a href="modules.php" class="link text">Modules</a>
    </div>
    <div class="left-align link-container">
        <a href="announcements.php" class="link text">Announcements</a>
    </div>
    <div class="left-align link-container">
        <a href="discussions.php" class="link text">Discussions</a>
    </div>
    <div class="left-align link-container">
        <a href="assignments.php" class="link text">Assignments</a>
    </div>
    <div class="left-align link-container">
        <a href="quizzes.php" class="link text">Quizzes</a>
    </div>
    <!-- FOR STUDENTS ONLY -->
    <?php if($_SESSION['role'] == "STUDENT")
    echo'
    <div class="left-align link-container">
        <a href="grades.php" class="link text">Grades</a>
    </div>
    '?>
    <div class="left-align link-container">
        <a href="z-test.php" class="link text">Test</a>
    </div>
</div>