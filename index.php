<?php

require './function.php';

$news = query("SELECT * FROM news");

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
    <div class="container">
        <a href="./create.php" class="btn btn-sm btn-primary mt-3">Create</a>
        <table class="table table-hover mt-5">
            <thead class="table-dark">
                <th>Image</th>
                <th>Title</th>
                <th>Action</th>
            </thead>

            <tbody>
                <?php foreach ($news as $data) :?>
                    <tr>
                        <td>
                            <img src="img/<?= $data["images"] ?>" alt="" width="300">
                        </td>
                        </td>
                        <td><?= $data["title"] ?></td>
                        <td>
                            <a href='update.php?id=<?= $data["id"] ?>' class='btn btn-sm btn-warning'>Update</a>
                            <a href='delete.php?id=<?= $data["id"] ?>' class='btn btn-sm btn-danger'>Delete</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>

</html>