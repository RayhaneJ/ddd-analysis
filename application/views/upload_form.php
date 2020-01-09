<html>
<head>
<script src="<?php echo base_url();?>/application/js/newChapitre.js"></script>    
<link rel = "stylesheet" type = "text/css" 
    href = "<?php echo base_url(); ?>/application/css/upload_form.css">
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('upload/do_upload');?>

<div id="container">
    <div id = "centerwrapper">
<div id="upload">
<input type="file" name="userfile" size="20" />

<input type="submit" value="upload" />
</div>

<div id="chapitre">
<div id="listeDynamique">
    <input type="button" value="Ajouter un nouveau chapitre" onclick="createNewElement();"/>
</div>

<div id="newElementId"> 

</div>
</div>
</div>
</div>
</form>


</body>
</html>