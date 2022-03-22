<?php
include './function.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>CRUD App</title>
</head>

<body>
    <h1 class="text-center mt-5">CREATE DATA</h1>
    <div class="w-50 mx-auto border p-3 mt-5">
        <a href="./index.php" class="btn btn-primary mb-3">Back</a>
        <form action="create.php" method="POST" enctype="multipart/form-data">
            <label for="title" class="mb-2">Title</label>
            <input type="text" id="title" class="form-control mb-3" name="title" required>
            <label for="images" class="mb-2">Images</label>
            <input type="file" id="images" name="images" class="form-control mb-3" required>
            <p class="fw-lighter">File Type: * .png / * .gif / * .jpg</p>
            <p class="fw-lighter">Recommended Size: 1000px x 500px</p>

            <input type="submit" class="btn btn-success" value="Save" name="submit">
        </form>
    </div>
    <?php
    if (isset($_POST["submit"])) {

        if (created($_POST) > 0) {
            echo "
            <div class='alert alert-success mt-5' role='alert'>
                Create Success!
            </div>
                ";
        } else {
            echo "
            <div class='alert alert-danger mt-5' role='alert'>
                Create Error!
            </div>
                 ";
        }
    }

    ?>
</body>

</html>