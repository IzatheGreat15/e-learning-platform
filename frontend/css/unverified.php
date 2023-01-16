<!-- MODAL FOR UNVERIFIED ACCOUNTS -->
<!-- ONLY IF THE ACCOUNT IS NOT YET VERIFIED -->
<?php if($_SESSION["isVerified"] == "FALSE"): ?>
<div id="modal-delete" class="modal-bg" style="display: block; z-index: 300">
    <div class="modal-body">
        <div class="centered-align flex-col">
            <h3>Your account has not yet been verified.</h3>
            <form action="<?= $url ?>backend/send_verification_email.php" method="POST">
                <input type="hidden" name="email" value="<?= mysqli_fetch_assoc($db->query("SELECT email FROM users WHERE id = ".$_SESSION['user_id']))['email'] ?>">
                <button type="submit" name="submit" class="blue">VERIFY ACCOUNT</button>
            </form>
        </div>
    </div>
</div>
<?php endif ?>