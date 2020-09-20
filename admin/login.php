<?php include("includes/header.php") ?>

<?php if ($session->is_SignedIn()) {redirect("index.php");} ?>

<?php

if(isset($_POST['submit'])){

    $username = trim($_POST['username']) ;
    $password = trim($_POST['password']);
// login 
$userfound = User::verifyUser($username,$password);


if ($userfound) {
    $session->login($userfound);
    redirect('/photo-gallery/index.php');
} else {
    $msg = "username or password is incorrect";
}

} else {
    $username = '' ;
    $password = '';
    $msg = '';
}

?>




<div class="container">
    <div class="row justify-content-center align-items-center" style="height:100vh">
        <div class="col-4">
            <div class="card">
            <h4 class="bg-danger"><?php echo $msg ?> </h4>
                <div class="card-body">
                    <form action="" autocomplete="off" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <button type="submit" id="sendlogin" class="btn btn-primary" name="submit" value="submit">login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
