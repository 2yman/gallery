<?php include("includes/header.php"); ?>

<?php if (!$session->is_SignedIn()) {
    redirect("login.php");
} ?>

<?php
$message = "";

if (isset($_POST['submit'])) {
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->setFile($_FILES['file_upload']);
    if ($photo->save()) {
        $message = "<p class='text-success'>photo uploaded succesfully</p>";
    } else {
        $message = "<p class='text-danger'>" . join("<br>", $photo->errors) . "</p>";
    }
}


?>

<div id="layoutSidenav">

    <?php include("includes/side_nav.php"); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Upload</h1>
                <!-- upload section -->
                <section>
                    <div class="container p-5">
                        <div class="row">
                            <div class="col-lg-5 mx-auto">
                                <div class="p-5 bg-white shadow rounded-lg">
                                    <?php echo $message; ?>
                                    <form action="upload.php" method="post" enctype="multipart/form-data">
                                        <p>Upload file:</p>
                                        <input type="text" name="title" class="form-control" placeholder="title"><br>
                                        <div class="custom-file mb-3">
                                            <input type="file" class="custom-file-input" id="customFile" name="file_upload">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <?php include("includes/footer.php"); ?>


    </div>
</div>

<?php include("includes/end.php"); ?>