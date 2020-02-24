<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ManipulationSlides {
    private static $initialized = false;
    
    public static function intialize() {
        if(self::$initialized){
            return;
        }
        
        self::$initialized = true;
    }

    public static function ExtractZipSlide($fileName) {
        $zip = new ZipArchive;
        $path = $_SERVER['DOCUMENT_ROOT'].'/SiteWebIntegrationWeb/uploads/sourcesSlides/'.$fileName;
        $res = $zip->open($path);

        $pathInfo = pathinfo($_SERVER['DOCUMENT_ROOT'].'/SiteWebIntegrationWeb/uploads/sourceSlides/'.$fileName);
        $fileNameWithoutExtension = $pathInfo['filename'];

        shell_exec('mkdir '.$_SERVER['DOCUMENT_ROOT'].'/SiteWebIntegrationWeb/uploads/slidesFiles/'.$fileNameWithoutExtension);

        if($res === TRUE) {
            for($i = 0; $i <$zip->numFiles; $i++){
            $fileName = $zip->getNameIndex($i);
            $fileinfo = pathinfo($fileName);
            copy("zip://".$path."#".$fileName, $_SERVER['DOCUMENT_ROOT'].'/SiteWebIntegrationWeb/uploads/slidesFiles/'.$fileNameWithoutExtension.'/'.$fileinfo['basename']);
            }
            $zip->close();
        }
        
        return $fileNameWithoutExtension;
    }

    //folderName = ZipFileNameWithoutExtension
    public static function GetJpgEmplacement($folderName) {
        $dir = $_SERVER['DOCUMENT_ROOT'].'/SiteWebIntegrationWeb/uploads/slidesFiles/'.$folderName;
        $scanned_directory = array_diff(scandir($dir), array('..', '.'));
        natsort($scanned_directory);

        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                foreach($scanned_directory as $value) {
                    $data = array(
                        'emplacement' => 'uploads/slidesFiles/'.$folderName."/".$value
                    );
                }
                closedir($dh);
                return $data;
            }
        }
    }

    public static function ExtractZip($emplacement){
        $zip = new ZipArchive;

        if($zip->open($emplacement)){
            $folderName = trim($zip->getNameIndex(0)); 
            $folderName = explode("/", $folderName);
            $folderName = $folderName[0];

            $zip->extractTo("uploads/sourcesSlides");

            $renameName = date('YmdHis') . '_' . rand(1, 1000) . $folderName;
            rename($_SERVER['DOCUMENT_ROOT']."/SiteWebIntegrationWeb/uploads/sourcesSlides/".$folderName, $_SERVER['DOCUMENT_ROOT']."/SiteWebIntegrationWeb/uploads/sourcesSlides/".$renameName);
            
            $zip->close();
        }
        unlink($_SERVER['DOCUMENT_ROOT'].'/SiteWebIntegrationWeb/'.$emplacement);

        return $renameName;
    } 

    public static function GetFiles($emplacement){
        $path = $_SERVER['DOCUMENT_ROOT'].'/SiteWebIntegrationWeb/'.$emplacement;
        
        $files = array_diff(scandir($path), array('.', '..'));
        natsort($files);

        return $files;
    }
}
