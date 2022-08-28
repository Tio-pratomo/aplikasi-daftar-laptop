<?php
function upload()
{
    $imageName = $_FILES["image"]["name"] ?? "";
    $imageSize = $_FILES["image"]["size"] ?? "";
    $error = $_FILES["image"]["error"] ?? "";
    $tempFiles = $_FILES["image"]["tmp_name"] ?? "";


    if ($error === 4) {
        echo <<< label
        <script>
            Swal.fire({
                icon: 'error',
                title: 'upload gambarnya jangan lupa ya!!',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = "../../index.php";
            })
        </script>
        label;
        return false;
    }

    $extentionFileValid = ["jpg", "jpeg", "png"];
    $extentionImageFile = explode(".", $imageName);
    $extentionValid = strtolower(end($extentionImageFile));
    $newImageName = uniqid();
    $newImageName .= "." . $extentionValid;

    $destinationImage = __DIR__ . "/../public/images/{$newImageName}";



    if (!in_array($extentionValid, $extentionFileValid)) {
        echo <<< label
        <script>
            Swal.fire({
                icon: 'error',
                title: 'tolong upload file dengan extensi jpg, jpeg, atau png',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = "../../index.php";
            })
        </script>
        label;
        return false;
    }

    if ($imageSize > 2_097_152) {
        echo <<< label
        <script>
            Swal.fire({
                icon: 'error',
                title: 'file gambar terlalu besar',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = "../../index.php";
            })
        </script>
        label;
        return false;
    }

    move_uploaded_file($tempFiles, $destinationImage);
    return $newImageName;
}
