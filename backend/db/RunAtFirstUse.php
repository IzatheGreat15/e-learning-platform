<?php
    // include("initial_db.php");

    include("config.php");
    if ($db->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // include("create_users_table.php");
    // include("create_sections_table.php");
    // include("create_enrollments_table.php");
    // include("create_subjects_table.php");
    // include("create_subject_group_table.php");
    
    // include("create_modules_table.php");
    // include("create_pages_table.php");

    include("create_assignment_files_table.php");
    include("create_page_files_table.php");

    // include("create_quizzes_table.php");
    // include("create_quiz_items_table.php");
    // include("create_quiz_responses_table.php");
    
    // include("create_assignments_table.php");
    // include("create_assignment_responses_table.php");

    // include("create_class_announcements_table.php");
    // include("create_subject_announcements_table.php");

    // include("create_threads_table.php");
    // include("create_messages_table.php");

    $db->close();
?>