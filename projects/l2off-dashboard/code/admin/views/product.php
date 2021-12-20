<?php
require 'crud/insert.php';
guard($_SESSION['id'], $_COOKIE['password']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nameCrypt = md5($_FILES['imageUploaded']['tmp_name'] . rand(0, 999)) . ".jpg";

    if (setTemplate($_POST['plan'], $_POST['price'], $_POST['chronic'], $_POST['project'], $_POST['plataform'], $_POST['category'], $nameCrypt) === true) {

        $path = 'uploaded/';
        $uploadFile = $path . basename($nameCrypt);
        move_uploaded_file($_FILES['imageUploaded']['tmp_name'], $uploadFile);
        
    }
}
?>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Register</h4>
        <p class="card-description">
            Template lineage2
        </p>
        <form class="forms-sample" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleSelectGender">Plan</label>
                <select class="form-control" name="plan" id="exampleSelectGender">
                    <option value="0">Free</option>
                    <option value="1">Pro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="targetPrice">Price</label>
                <input type="num" class="form-control" name="price" maxlength="11" placeholder="$" id="targetPrice">
            </div>
            <div class="form-group">
                <label for="exampleSelectGender">Chronic</label>
                <select class="form-control" name="chronic" id="exampleSelectGender">
                    <option value="Interlude">Interlude</option>
                    <option value="Sinos of Destiny">Sions Of Destiny</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleSelectGender">Project</label>
                <select class="form-control" name="project" id="exampleSelectGender">
                    <option value="acis">ACIS</option>
                    <option value="frozen">FROZEN</option>
                    <option value="l2off">L2OFF</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleSelectGender">Plataform</label>
                <select class="form-control" name="plataform" id="exampleSelectGender">
                    <option value="java">PTS</option>
                    <option value="pts">L2J</option>
                </select>
            </div>
            <div class="form-group">
                <label for="targetCategory">Category</label>
                <input type="text" class="form-control" name="category" maxlength="1" placeholder="a,b,c,d,e..." id="targetCategory">
            </div>
            <div class="form-group">
                <label>File upload</label>
                <input type="file" id="tempImage" name="imageUploaded" class="file-upload-default">
                <div class="input-group col-xs-12">
                    <input type="text" id="tempImageName" class="form-control file-upload-info" disabled placeholder="Upload Image">
                    <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" id="tempImageBtn" type="button">Upload</button>
                    </span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('tempImageBtn').addEventListener('click', openDialog);

    function openDialog() {
        document.getElementById('tempImage').click();
    }

    $('#tempImage').change(function(e) {

        var fileData = e.target.files[0].name;
        //console.log(e.target.files[0]);
        $('#tempImageName').val(fileData);

    });
</script>