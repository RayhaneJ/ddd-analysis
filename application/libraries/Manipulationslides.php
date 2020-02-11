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
        $path = $_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/sourcesSlides/'.$fileName;
        $res = $zip->open($path);

        $pathInfo = pathinfo($_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/sourceSlides/'.$fileName);
        $fileNameWithoutExtension = $pathInfo['filename'];

        shell_exec('mkdir '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/slidesFiles/'.$fileNameWithoutExtension);

        if($res === TRUE) {
            for($i = 0; $i <$zip->numFiles; $i++){
            $fileName = $zip->getNameIndex($i);
            $fileinfo = pathinfo($fileName);
            copy("zip://".$path."#".$fileName, $_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/slidesFiles/'.$fileNameWithoutExtension.'/'.$fileinfo['basename']);
            }
            $zip->close();
        }
        
        return $fileNameWithoutExtension;
    }

    public static function InsertSlidesInDB($fileNameWithoutExtension, $fileName){
        $dir = $_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/slidesFiles/'.$fileNameWithoutExtension;
        $scanned_directory = array_diff(scandir($dir), array('..', '.'));
        natsort($scanned_directory);
        $CI = & get_instance();
        $CI->load->library('Dataaccess');

        $zipId = $CI->dataaccess::getIdByFileNameZip($fileName);

        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                foreach($scanned_directory as $value) {
                    $data = array(
                        'emplacement' => 'uploads/slidesFiles/'.$fileNameWithoutExtension."/".$value
                    );
                    $jpgId = $CI->dataaccess::InsertJpg($data);
                    $data = array(
                        'idSlideZip' => $zipId,
                        'idSlideJpg' =>$jpgId
                    );
                    $CI->dataaccess::InsertJpgToSlide($data);
                }
                closedir($dh);
            }
                
        }
    }
}
