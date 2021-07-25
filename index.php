<?php

include 'config.php';

$link = "";
$link_status = "display: none;";

if(isset($_POST['upload'])){
    $location = "uploads/";
    $file_new_name = date("dmy") . time() . $_FILES["file"]["name"];
    $file_name = $_FILES["file"]["name"];
    $file_temp = $_FILES["file"]["tmp_name"];
    $file_size = $_FILES["file"]["size"];

    if($file_size > 10485760){
        echo "<script>alert('Opa! Arquivo pesado')</script>";
    } else {
        $sql = "INSERT INTO uploaded_files(name, new_name) VALUES ('$file_name', '$file_new_name')";
        $result = mysqli_query($conn, $sql);
        if($result){
            move_uploaded_file($file_temp, $location . $file_new_name);
            echo "<script>alert('Wow! Arquivo baixado com sucesso')</script>";
            //Selecionar o id do banco
            $sql = "SELECT id FROM uploaded_files ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
            if($row = mysqli_fetch_assoc($result)){
                $link = $base_url ."download.php?id=" . $row['id'];
                $link_status = "display: block;";
            }
        } else {
            echo "<script>alert('Opa! Algo deu errado')</script>";
        }
        
    }
}


?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://use.fontawesome.com/3dfd196d26.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Upload System</title>
</head>
<body>
    <div class="file_upload">
        <div class="header">
            <p><i class="fa fa-cloud-upload fa-2x"></i><span><span>up</span>load</span></p>
        </div>
        <form action="" method="POST" enctype="multipart/form-data" class="body">
        <!-- Link de compartilhamento -->
        <input type="checkbox" id="link_checkbox">
        <input type="text" value="<?php echo $link; ?>" id="link"  readonly>
        <label for="link_checkbox" style="<?php echo $link_status; ?>">Obtenha um link para compartilhar</label>
        <!---->
            <input type="file" name="file" id="upload" required>
            <label for="upload">
                <i class="fa fa-file-text-o fa-3x"></i>
                <p>
                    <strong>Selecione ou jogue</strong> os arquivos aqui<br> 
                </p>
            </label>
            <button type="submit" name="upload" class="btn">Upload</button>
        </form>
    </div>
</body>
</html>