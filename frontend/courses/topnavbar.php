<?php
    $user = mysqli_fetch_assoc($db->query("SELECT fname, lname, role, pp_location FROM users WHERE id = ".$_SESSION['user_id']));
    $fname = $user['fname'];
    $lname = $user['lname'];
    $role = $user['role'];
?>

<div class="flex flex-col front" style="width: 100%">
    <div class="blue flex flex-col">
        <div class="left-align">
            <a class="img-container centered-align p-5" href="account-settings.php">
                <img src="../files/profile/<?= mysqli_fetch_assoc($db->query("SELECT pp_location FROM users WHERE id = ".$_SESSION['user_id']))['pp_location'] ?>" class="small" alt="logo">
            </a>
            <h4 style="margin: 0; padding: 0; cursor: default"><?= $fname." ".$lname." (".$role.")" ?></h4>
            <div class="centered-align">
                <div class="centered-align">
                    <label for=""><?php echo date("D | F d, Y", time()) ?></label>
                </div>
                <div class="btn bell">
                    <img src="../images/bell-white.png" class="small" alt="logo">
                </div>
            </div>
        </div>
    </div>

    <!-- NOTIFICATIONS -->
    <?php 
        $notifs = $db->query($_SESSION['role'] == "STUDENT" ? "SELECT * FROM notifications JOIN subject_group ON notifications.sg_id = subject_group.id JOIN sections ON sections.id = subject_group.section_id WHERE section_id = ".$_SESSION['section_id']." ORDER BY notifications.created_on DESC" : "SELECT * FROM notifications JOIN subject_group ON notifications.sg_id = subject_group.id WHERE subject_group.teacher_id = ".$_SESSION['user_id']." ORDER BY notifications.created_on DESC")
    ?>
    <?php if($notifs->num_rows > 0): ?>
    <?php foreach($notifs as $notif): ?>
    <div class="flex notifications" style="justify-content: flex-end; display: none;">
        <div class="flex flex-col blue" style="z-index: 10; width: 30%;">
            <div class="left-align link-container" style="margin-top: -1px">
            <a href="<?= $notif['link'] ?>" class="link" style="color: white"><?= $notif['message'] ?></a>
            </div>
        </div>
    </div>
    <?php endforeach ?>
    <?php else: ?>
        <div class="flex notifications" style="justify-content: flex-end; display: none;">
        <div class="flex flex-col blue centered-align" style="z-index: 10; width: 30%;">
            <p>No Notification</p>
        </div>
        </div>
    <?php endif ?>
</div>