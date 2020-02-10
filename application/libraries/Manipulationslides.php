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
        $path = pathinfo($_SERVER['DOCUMENT_ROOT'].'IntegrSupCours/uploads/sourceSlides/'.$fileName);
        $fileNameWithoutExtension = $path['filename'];

        shell_exec('mkdir '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/slidesFiles/'.$fileNameWithoutExtension);
        shell_exec('unzip '.$_SERVER['DOCUMENT_ROOT'].'IntegrSupCours/uploads/sourcesSlides/'.$fileName.' -d '.$_SERVER['DOCUMENT_ROOT'].'IntegrSupCours/uploads/sourceSlides/'.$fileNameWithoutExtension);

        return $fileNameWithoutExtension;
    }

    public static function InsertSlidesInDB($fileNameWithoutExtension, $fileName){
        $dir = $_SERVER['DOCUMENT_ROOT'].'IntegrSupCours/uploads/sourcesSlides/'.$fileNameWithoutExtension;
        
        $CI = & get_instance();
        $CI->load->library('Dataaccess');

        $zipId = $CI->dataaccess::getIdByFileNameZip($fileName);

        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    $data = array(
                        'emplacement' => 'uploads/slidesFiles/'.$file
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