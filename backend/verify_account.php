<?

include("config.php");
session_start();

if(isset($_GET['$token'])){
    $token = $_GET['token'];
    if($db->query("UPDATE users SET verified_on = CURRENT_TIMESTAMP where token = ".$token)){
        $user = mysqli_fetch_assoc($db->query("SELECT * FROM users WHERE token = ".$token));

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['id'];

        header("location: ../frontend/verify-email.php?msg=accountVerified");
    }
}else{
    header("location: ../frontend/index.php?msg=verificationFailed");
}
