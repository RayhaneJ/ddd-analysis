<?php
$emplacement = $argv[1];

$serverRoot = "/var/www/";

//A CHANGER
$path = $serverRoot."/".$emplacement;

$files = array_diff(scandir($path), array('.', '..'));
natsort($files);

$folderSlide = str_replace('uploads/sourcesSlides/',"", $emplacement);
$folderName = date('YmdHis') . '_' . rand(1, 1000).$folderSlide."Thumbnails";

$pathFolderName = $serverRoot."/uploads/thumbnails/".$folderName;
mkdir($pathFolderName,0775, TRUE);

$i=0;
foreach($files as $file) {
    shell_exec("convert " .$serverRoot."/".$emplacement."/".$file." -trim -resize 300x300 ".$pathFolderName."/thumbnail".$i.".png");                                                                    
    $i++;
}

$emplacementThumbnailsCreated = "uploads/thumbnails/".$folderName;

echo $emplacementThumbnailsCreated;

return $emplacementThumbnailsCreated;
?>
