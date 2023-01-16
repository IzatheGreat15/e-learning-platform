<?php

// sql to create table
$sql = "INSERT users (fname,lname,role,address,contact_num,email,password, token) VALUES
                    ('sample', 'admin', 'ADMIN', 'home', '09776919206', 'sample_admin@gmail.com', '".password_hash('password', PASSWORD_DEFAULT)."', '".password_hash('passwordsample_admin@gmail.com', PASSWORD_DEFAULT)."'),
                    ('sample', 'admin', 'STUDENT', 'home', '09776919206', 'sample_student@gmail.com', '".password_hash('password', PASSWORD_DEFAULT)."', '".password_hash('passwordsample_student@gmail.com', PASSWORD_DEFAULT)."'),
                    ('sample', 'admin', 'TEACHER', 'home', '09776919206', 'sample_teacher@gmail.com', '".password_hash('password', PASSWORD_DEFAULT)."', '".password_hash('passwordsample_teacher@gmail.com', PASSWORD_DEFAULT)."'),
                    ('sample', 'admin', 'REGISTRAR', 'home', '09776919206', 'sample_registrar@gmail.com', '".password_hash('password', PASSWORD_DEFAULT)."', '".password_hash('passwordsample_registrar@gmail.com', PASSWORD_DEFAULT)."')";
                    // ('sample', 'student01', 'STUDENT', 'home', '09776919206', 'sample_student01@gmail.com', '".password_hash('password', PASSWORD_DEFAULT)."'),
                    // ('sample', 'student02', 'STUDENT', 'home', '09776919206', 'sample_student02@gmail.com', '".password_hash('password', PASSWORD_DEFAULT)."'),
                    // ('sample', 'student03', 'STUDENT', 'home', '09776919206', 'sample_student03@gmail.com', '".password_hash('password', PASSWORD_DEFAULT)."'),
                    // ('sample', 'teacher01', 'TEACHER', 'home', '09776919206', 'sample_teacher01@gmail.com', '".password_hash('password', PASSWORD_DEFAULT)."'),
                    // ('sample', 'teacher02', 'TEACHER', 'home', '09776919206', 'sample_teacher02@gmail.com', '".password_hash('password', PASSWORD_DEFAULT)."'),
                    // ('sample', 'teacher03', 'TEACHER', 'home', '09776919206', 'sample_teacher03@gmail.com', '".password_hash('password', PASSWORD_DEFAULT)."')";

if ($db->query($sql) === TRUE) {
  echo "\nTable users seeded successfully";
} else {
  echo "\nError seeding table: " . $db->error;
}
?>