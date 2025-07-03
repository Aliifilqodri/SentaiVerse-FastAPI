<?php
// Set direktori tujuan penyimpanan gambar
$targetDir = "../static/images/";
$targetFile = $targetDir . basename($_FILES["image"]["name"]);
$imageName = "images/" . basename($_FILES["image"]["name"]);

if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
    // Ambil data dari form
    $data = [
        "name" => $_POST["name"],
        "color" => $_POST["color"],
        "team" => $_POST["team"],
        "image" => $imageName
    ];

    // Kirim data ke API
    $options = [
        "http" => [
            "header" => "Content-type: application/json\r\n",
            "method" => "POST",
            "content" => json_encode($data)
        ]
    ];
    $context = stream_context_create($options);
    $result = @file_get_contents("http://127.0.0.1:8000/sentai/", false, $context);

    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "❌ Gagal mengirim data ke API.";
    }
} else {
    echo "❌ Gagal upload gambar.";
}
?>
