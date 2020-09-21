<?php include("includes/header.php"); ?>
<?php if (!$session->is_SignedIn()) {redirect("login.php");} ?>

<div id="layoutSidenav">

    <?php include("includes/side_nav.php"); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Dashboard</h1>

            </div>
            <?php

                // $user = new User();
                // $user->username = "user1";
                // $user->password = "pass1";
                // $user->first_name = "user1";
                // $user->last_name = "user1";
                // $user->create();
                // echo $user->id;
                $user = User::findUserById(6);
                $user->first_name = "submit";
                $user->last_name = "sadfghj";
                $user->save();
                


            ?>
        </main>
        <?php include("includes/footer.php"); ?>

    </div>
</div>
