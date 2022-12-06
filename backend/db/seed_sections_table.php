<?php

// sql to create table
$sql = "INSERT sections (section_name, year_level, school_year) VALUES
                    ('Bola-Bola', 1, 2022),
                    ('Siopao', 1, 2022),
                    ('Siomai', 1, 2022),
                    ('Orange Chicken', 1, 2022),
                    ('Chicken Feet', 1, 2022),
                    ('Dumplings', 1, 2022),
                    ('Gyoza', 2, 2022),
                    ('Ramen', 2, 2022),
                    ('Sushi', 2, 2022),
                    ('Sashimi', 2, 2022),
                    ('Tonkatsu', 2, 2022),
                    ('Tempura', 2, 2022),
                    ('Kare-Kare', 3, 2022),
                    ('Sinigang', 3, 2022),
                    ('Lechon', 3, 2022),
                    ('Sisig', 3, 2022),
                    ('Tinola', 3, 2022),
                    ('Paksiw', 3, 2022)";

if ($db->query($sql) === TRUE) {
  echo "\nTable sections seeded successfully";
} else {
  echo "\nError seeding table: " . $db->error;
}
?>