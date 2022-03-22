<?php

$conn = mysqli_connect("localhost", "root", "", "crud");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function created($data)
{
    global $conn;
    $title = $data["title"];

    $images = uploadImage();
    if (!$images) {
        return false;
    }

    $query = "INSERT INTO news 
    VALUES (id, '$title', '$images')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function uploadImage()
{
    $fileName = $_FILES['images']['name'];
    $fileSize = $_FILES['images']['size'];
    $error = $_FILES['images']['error'];
    $tmpName = $_FILES['images']['tmp_name'];

    if ($error === 4) {
        echo "<script>
        alert('Choose images first!');
            </script>";
        return false;
    }

    $imagesValid = ['jpg', 'jpeg', 'png'];
    $extImages = explode('.', $fileName);
    $extImages = strtolower(end($extImages));

    if (!in_array($extImages, $imagesValid)) {
        echo "<script>
        alert('Sorry not an image!');
            </script>";
        return false;
    }

    if ($fileSize > 1000000) {
        echo "<script>
        alert('Size image to big!');
            </script>";
        return false;
    }

    $newFileName = uniqid();
    $newFileName .= '.';
    $newFileName .= $extImages;
    $targetDir = getcwd() . "/img/";


    move_uploaded_file($tmpName, $targetDir . $newFileName);
    return $newFileName;
}

function deleted($id)
{
    global $conn;

    $result = mysqli_query($conn, "SELECT images FROM news WHERE id = $id");
    $file = mysqli_fetch_assoc($result);
    $fileName = implode('.', $file);
    $location = "/img/$fileName";
    if (file_exists($location)) {
        unlink('/img/' . $fileName);
    }

    mysqli_query($conn, "DELETE FROM news WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function updated($data)
{
    global $conn;
    $id = $data["id"];
    $title = $data["title"];
    $oldImages = $data["oldImages"];

    if ($_FILES['images']['error'] === 4) {
        $images = $oldImages;
    } else {
        $result = mysqli_query($conn, "SELECT images FROM news WHERE id = $id");
        $file = mysqli_fetch_assoc($result);

        $fileName = implode('.', $file);
        unlink('/img/' . $fileName);
        $images = uploadImage();
    }

    $query = "UPDATE news SET 
                title = '$title',
                images = '$images'
                WHERE id = $id
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
