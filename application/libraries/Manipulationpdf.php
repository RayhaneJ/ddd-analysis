<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class ManipulationPdf {

        private static $initialized = false;

        public static function intialize(){

            if (self::$initialized) {
                return;
            }

            self::$initialized = true;
        }
        //2
        public static function addSummaryToPdfBookmark($dataSummary, $pdfName){
            $bookmarkFileName = date('YmdHis') . '_' . rand(1, 1000).'bookmark.txt';
            shell_exec('pdftk '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/sourcePdf/'.$pdfName.' dump_data output '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/metaDonnees/'.$bookmarkFileName);
            $file = $_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/metaDonnees/'.$bookmarkFileName;
            $txt="";
    
            foreach($dataSummary as $item => $value){
                $txt.="BookmarkBegin\nBookmarkTitle: " . $value[0] . "\nBookmarkLevel: 1\nBookmarkPageNumber: " . $value[1] ."\n";
            }
    
            file_put_contents($file, $txt);
            return $bookmarkFileName;
        }
    
        //meilleure nom de fonctions possible
        //1
        public static function ConvertPdf($dataSummary, $pdfName, $pdgName) {
            $bookmarkFileName = self::addSummaryToPdfBookmark($dataSummary, $pdfName);
            $fileNameGen = date('YmdHis') . '_' . rand(1, 1000) .$pdfName;
            shell_exec('pdftk '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/sourcePdf/'.$pdfName.' update_info '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/metaDonnees/'.$bookmarkFileName.' output '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/sourcePdfSummary/[Summary]'.$pdfName);
            self::AddPdgToPdg($pdgName, $pdfName, $fileNameGen);
            return $fileNameGen;
        }
        //4
        public static function IntegrationPdf($csvName, $pdfName, $pdgName){
            $dataSummary = self::csvStringToArray(file_get_contents('./uploads/csv/'.$csvName));
            $fileNameGen = self::ConvertPdf($dataSummary, $pdfName, $pdgName);
            return $fileNameGen;
        }
        //3
        public static function AddPdgToPdg($pdgEmplacement, $pdfName, $fileNameGen){
            shell_exec('pdftk '.$_SERVER['DOCUMENT_ROOT'].''.$pdgEmplacement.' '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/sourcePdfSummary/[Summary]'.$pdfName.' cat output '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/integrationPdf/'.$fileNameGen);
        }
    
    
        public static function csvStringToArray($string, $separatorChar = ';', $enclosureChar = '"', $newlineChar = "\n") {
            $array = array();
            $size = strlen($string);
            $columnIndex = 0;
            $rowIndex = 0;
            $fieldValue="";
            $isEnclosured = false;
            for($i=0; $i<$size;$i++) {
        
                $char = $string{$i};
                $addChar = "";
        
                if($isEnclosured) {
                    if($char==$enclosureChar) {
        
                        if($i+1<$size && $string{$i+1}==$enclosureChar){
                            // escaped char
                            $addChar=$char;
                            $i++; 
                        }else{
                            $isEnclosured = false;
                        }
                    }else {
                        $addChar=$char;
                    }
                }else {
                    if($char==$enclosureChar) {
                        $isEnclosured = true;
                    }else {
        
                        if($char==$separatorChar) {
        
                            $array[$rowIndex][$columnIndex] = $fieldValue;
                            $fieldValue="";
        
                            $columnIndex++;
                        }elseif($char==$newlineChar) {
                            echo $char;
                            $array[$rowIndex][$columnIndex] = $fieldValue;
                            $fieldValue="";
                            $columnIndex=0;
                            $rowIndex++;
                        }else {
                            $addChar=$char;
                        }
                    }
                }
                if($addChar!=""){
                    $fieldValue.=$addChar;
        
                }
            }
        
            if($fieldValue) { // save last field
                $array[$rowIndex][$columnIndex] = $fieldValue;
            }
            return $array;
        }
}