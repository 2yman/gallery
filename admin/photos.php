<?php include("includes/header.php"); ?>
<?php if (!$session->is_SignedIn()) {redirect("login.php");} ?>
<?php

$photos = Photo::findAll();


?>
<div id="layoutSidenav">

    <?php include("includes/side_nav.php"); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Photos</h1>

                <div class="col-md-12">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>photo</th>
                                <th>id</th>
                                <th>file name</th>
                                <th>title</th>
                                <th>size</th>
                            </tr>
                        </thead>

                        <tbody>
                             <?php foreach ($photos as $photo ) :?>
                            <tr>

                                <td><img src="<?php echo $photo->picPath(); ?>" alt="<?php echo $photo->title ?>" class="photo-table">
                                <div class="pic-link">

                                    <a class="btn btn-danger" href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                                    <a class="btn btn-warning" href="#">Edit</a>
                                    <a class="btn btn-primary" href="#">View</a>

                                </div>
                                
                                </td>
                                <td><?php echo $photo->id ?></td>
                                <td><?php echo $photo->filename ?></td>
                                <td><?php echo $photo->title ?></td>
                                <td><?php echo $photo->size ?></td>

                            </tr>
                            <?php endforeach; ?>


                        </tbody>



                    </table>

                </div>

            </div>
        </main>
        <?php include("includes/footer.php"); ?>

    </div>
</div>

<?php include("includes/end.php"); ?>