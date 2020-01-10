<html>

<head>
<script src="<?php echo base_url();?>/application/js/newChapitre.js"></script>    
<link rel = "stylesheet" type = "text/css" 
    href = "<?php echo base_url(); ?>/application/css/upload_form.css">
<title>Upload Form</title>
</head>

<body>

<?php // echo $error;?>

<?php echo form_open_multipart('upload/do_upload');?>

<div id="container">
    <div id = "centerwrapper">
        <div id="upload">
            <input type="file" name="fichiers[]"/>
            <input type="file" name="fichiers[]"/>
            <input type="file" name="fichiers[]"/>

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