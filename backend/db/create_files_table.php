<?php
// sql to create table
$sql = "CREATE TABLE files (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    use_id INT(6) UNSIGNED,
    use_type ENUM('MODULE', 'SUBMISSION') NOT NULL,
    file_location VARCHAR(1080),
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($db->query($sql) === TRUE) {
  echo "Table files created successfully";
} else {
  echo "Error creating table: " . $db->error;
}
?>