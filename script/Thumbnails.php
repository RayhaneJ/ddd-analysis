<?php
$emplacement = $argv[1];

$serverRoot = "/var/www/html/";

//A CHANGER
$path = $serverRoot."SiteWebIntegrationWeb/".$emplacement;

$files = array_diff(scandir($path), array('.', '..'));
natsort($files);

$folderSlide = str_replace('uploads/sourcesSlides/',"", $emplacement);

$folderName = date('YmdHis') . '_' . rand(1, 1000).$folderSlide."Thumbnails";
$pathFolderName = $serverRoot."SiteWebIntegrationWeb/uploads/thumbnails/".$folderName;
mkdir($pathFolderName,TRUE);

$i=0;
foreach($files as $file) {
    shell_exec("convert " .$serverRoot."SiteWebIntegrationWeb/".$emplacement."/".$file." -trim -resize 300x300 ".$pathFolderName."/thumbnail".$i.".png");
    echo "convert " .$serverRoot."SiteWebIntegrationWeb/".$emplacement."/".$file." -trim -resize 300*300 ".$pathFolderName."/thumbnail".$i.".png                                                                      ";
    $i++;
}

$emplacementThumbnailsCreated = "uploads/thumbnails/".$folderName;

return $emplacementThumbnailsCreated;
?>