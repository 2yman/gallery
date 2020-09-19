<?php include("includes/header.php"); ?>

<div id="layoutSidenav">

    <?php include("includes/side_nav.php"); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Dashboard</h1>

            </div>
            <?php

            $foundUser = User::findUserById(1);
            echo $foundUser->username;
            // $result = User::findUserById(1);
            //   $user = User::instantation($result);

            // echo $user->id;
            
            ?>
        </main>
        <?php include("includes/footer.php"); ?>

    </div>
</div>

<?php include("includes/end.php"); ?>
