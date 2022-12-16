<?php
   include("config.php");
   session_start();

    $year_level = $_GET['year'];
    $section = $_GET['section'];

    if($year_level == 0 && $section == 0)
        $sql = $db->query("SELECT u.id, s.year_level, u.fname, u.lname, u.pp_location, s.section_name FROM enrollments AS e LEFT JOIN users AS u ON u.id = e.student_id LEFT JOIN sections AS s ON s.id = e.section_id UNION SELECT id, 0 AS year_level, fname, lname, pp_location, 'unenrolled' AS section_name FROM users WHERE role = 'STUDENT' AND id NOT IN (SELECT u.id FROM enrollments AS e LEFT JOIN users AS u ON u.id = e.student_id LEFT JOIN sections AS s ON s.id = e.section_id)");
    else
        $sql = $db->query("SELECT u.id, s.year_level, u.fname, u.lname, u.pp_location, s.section_name FROM enrollments AS e LEFT JOIN users AS u ON u.id = e.student_id LEFT JOIN sections AS s ON s.id = e.section_id WHERE s.year_level = ".$year_level." AND e.section_id = ".$section);

    echo json_encode(mysqli_fetch_all($sql));
?>