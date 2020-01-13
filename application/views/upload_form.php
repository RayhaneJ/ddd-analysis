<html>

<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="<?php echo base_url();?>/application/js/newChapitre.js"></script>    
<link rel = "stylesheet" type = "text/css" 
    href = "<?php echo base_url(); ?>/application/css/upload_form.css">
<title>Upload Form</title>
</head>

<body>


<?php// echo $error; ?>

<?php echo form_open_multipart('upload/do_upload');?>

<div id="container">
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
</div>


</form>


</body>
</html>