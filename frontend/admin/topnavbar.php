<?php 
    $img = mysqli_fetch_assoc($db->query("SELECT pp_location FROM users WHERE id = ".$_SESSION['user_id']))['pp_location'];
?>
<div class="flex flex-col front" style="width: 100%">
    <div class="blue flex flex-col">
        <div class="left-align">
            <a class="img-container centered-align p-5" href="account-settings.php">
                <img src="../files/profile/<?= $img ?>" class="small" alt="logo">
            </a>
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
    <div class="flex notifications" style="justify-content: flex-end; display: none;">
        <div class="flex flex-col blue" style="z-index: 10; width: 30%;">
            <div class="left-align link-container" style="margin-top: -1px">
                <a href="home.php" class="link" style="color: white">Home</a>
            </div>
        </div>
    </div>
</div>