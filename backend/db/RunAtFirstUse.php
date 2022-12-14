<?php
    //creating database
    include("initial_db.php");

    include("config.php");
    if ($db->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    //creating tables
    include("create_users_table.php");
    include("create_subjects_table.php");
    include("create_sections_table.php");
    include("create_enrollments_table.php");
    include("create_subject_group_table.php");
    include("create_subject_announcements_table.php");
    
    include("create_modules_table.php");
    include("create_lessons_table.php");
    include("create_lesson_files_table.php");

    include("create_quizzes_table.php");
    include("create_quiz_items_table.php");
    include("create_quiz_responses_table.php");
    
    include("create_assignments_table.php");
    include("create_assignment_responses_table.php");
    include("create_assignment_files_table.php");

    include("create_notifications_table.php");

    include("create_threads_table.php");
    include("create_messages_table.php");

    include("create_discussions_table.php");
    include("create_discussion_replies_table.php");

    include("create_admin_announcements_table.php");

    //seeding tables
    if($needSeed == 1){
      include("seed_users_table.php");
      include("seed_subjects_table.php");
      include("seed_sections_table.php");
      include("seed_enrollments_table.php");
      include("seed_subject_group_table.php");
      include("seed_assignments_table.php");
    }
    header("location: frontend/index.php");
    
    $db->close();
?>