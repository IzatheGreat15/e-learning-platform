<div class="centered-align icon-container">
    <a href="dashboard.php">
        <img src="../images/dashboard-blue.png" class="small icon" alt="dashboard">
    </a>
</div>
<?php if($_SESSION["role"] == "ADMIN"): ?>
<div class="centered-align icon-container">
    <a href="courses.php">
        <img src="../images/courses-blue.png" class="small icon" alt="courses">
    </a>
</div>
<div class="centered-align icon-container">
    <a href="announcements.php">
        <img src="../images/announcement-blue.png" class="small icon" alt="announcement">
    </a>
</div>
<?php endif ?>
<div class="centered-align icon-container">
    <a href="people.php">
        <img src="../images/people-blue.png" class="small icon" alt="people">
    </a>
</div>
<div class="centered-align icon-container">
    <a href="enrollments.php">
        <img src="../images/enrollment-blue.png" class="small icon" alt="enrollment">
    </a>
</div>