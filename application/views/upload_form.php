<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href="<?php echo base_url();?>css/upload.css" rel="stylesheet">
<title>Upload Form</title>

</head>

<body>

<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<img src="/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" alt="">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="#">Features</a>
      <a class="nav-item nav-link" href="#">Pricing</a>
    </div>
  </div>
</nav>
</header>

<main>
<p id="demo"></p>
<div class="container h-100">
  <div class="row h-100 justify-content-center align-items-center">
    <form action="http://localhost/IntegrSupCours/upload/do_upload" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="col-12">
      <div class="custom-file mb-3">
      <input type="file" name="fichiers[]" class="custom-file-input" id="customFile"> 
      <label class="custom-file-label" for="customFile">Choose file</label>
    </div>
    <div class="custom-file mb-3 ">
      <input type="file" name="fichiers[]" class="custom-file-input" id="customFile"> 
      <label class="custom-file-label" for="customFile">Choose file</label>
    </div>
    <div class="custom-file mb-4 ">
      <input type="file" name="fichiers[]" class="custom-file-input" id="customFile"> 
      <label class="custom-file-label" for="customFile">Choose file</label>
    </div>
    <div class="form-row mb-4">
      <div class="col">
        <input type="text" class="form-control" placeholder="First name">
      </div>
      <div class="col">
        <input type="text" class="form-control" placeholder="Last name">
      </div>
    </div>
    <select class="custom-select custom-select-lg mb-4">
      <option selected>Open this select menu</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
    <button type="submit" class="btn btn-primary btn-lg btn-block">Block level button</button>
    
    </form>   
  </div>
</div>
</main>

<script type="text/javascript" src="js/upload.js"></script>
</body>

</html>