<html>

<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="<?php echo base_url();?>css/upload.css" rel="stylesheet">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<title>Upload Form</title>

</head>

<body>
<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<div class="image1">
    <img src="/docs/4.4/assets/brand/bootstrap-solid.svg" width="30" height="30" alt="">
</div>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="#">Intégration <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="#">Gestion</a>
      <a class="nav-item nav-link" href="#">Visualisation</a>
    </div>
  </div>
</nav>
</header>

<main>
<div class="container h-100">
    <div class="row align-items-center h-100">
        <div class="col-6 mx-auto">
            <div class="jumbotron">
            <div class="input-group mb-3 w-100">
                <div class="custom-file">
                <input type="file" name="fichiers[]" class="custom-file-input"  aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Insérez le fichier CSV</label>
                </div>
            </div>
            <div class="input-group mb-3 w-100">
                <div class="custom-file">
                <input type="file" name="fichiers[]" class="custom-file-input"  aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Insérez le support de cours</label>
                </div>
            </div>
            <div class="input-group mb-3 w-100">
                <div class="custom-file">
                <input type="file" name="fichiers[]" class="custom-file-input"  aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Insérez les diapositives</label>
                </div>
            </div>
            <div class="col text-center justify-content-center align-self-center">
                <button type="button" class="btn btn-secondary btn-lg">Large button</button>
            </div>
            </div>
        </div>
    </div>
</div>
</main>






<?php// echo $error; ?>

<?php echo form_open_multipart('upload/do_upload');?>

<!-- <div id="container">
    <div id = "centerwrapper">
        <div id="upload">
            <input type="file" name="fichiers[]" size="20"/>
            <input type="file" name="fichiers[]" size="20"/>
            <input type="file" name="fichiers[]" size="20"/>

            <input type="submit" value="upload" />
        </div>

        <div id="chapitres">
            <input type="text" name="nomCours"/>
            <input type="text" name="versionBaps"/>
        </div>

        <div id="chapitre">
        <div id="newElementId"> 
        </div>
    </div>
</div> -->


</form>


</body>
</html>