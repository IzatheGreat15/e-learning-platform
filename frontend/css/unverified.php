<!-- MODAL FOR UNVERIFIED ACCOUNTS -->
<!-- ONLY IF THE ACCOUNT IS NOT YET VERIFIED -->
<div id="modal-delete" class="modal-bg" style="display: block;">
    <div class="modal-body">
        <span class="close">&times;</span>
        <div class="centered-align flex-col">
            <h3>Your account has not yet been verified.</h3>
            <form action="../../backend/teacher/delete_assignment.php" method="POST">
                <input type="hidden" name="id" value="">
                <button type="submit" name="submit" class="blue">VERIFY ACCOUNT</button>
            </form>
        </div>
    </div>
</div>