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
        public static function AddSummaryToPdfBookmark($csvDataArray, $pdfFileName){
            
            $bookmarkFileName = date('YmdHis') . '_' . rand(1, 1000).'bookmark.txt';
            
            shell_exec('pdftk '.$_SERVER['DOCUMENT_ROOT'].'/uploads/sourcePdf/'.$pdfFileName.' dump_data output '.$_SERVER['DOCUMENT_ROOT'].'/uploads/metaDonnees/'.$bookmarkFileName);

            $metaDataFilePath = $_SERVER['DOCUMENT_ROOT'].'/uploads/metaDonnees/'.$bookmarkFileName;
            $txt="";
    
            foreach($csvDataArray as $item => $value){
                $txt.="BookmarkBegin\nBookmarkTitle: " . $value[0] . "\nBookmarkLevel: 1\nBookmarkPageNumber: " . $value[1] ."\n";
            }
    
            file_put_contents($metaDataFilePath, $txt);

            return $bookmarkFileName;
        }
    
        //1
        public static function ConvertPdfFile($csvDataArray, $pdfFileName, $coverPageFilePath=null) {

            $bookmarkFileName = self::AddSummaryToPdfBookmark($csvDataArray, $pdfFileName);
            $pdfGeneratedFileName = date('YmdHis') . '_' . rand(1, 1000) .$pdfFileName;

            if($coverPageFilePath == null) {
                
                shell_exec('pdftk '.$_SERVER['DOCUMENT_ROOT'].'/uploads/sourcePdf/'.$pdfFileName.' update_info '.$_SERVER['DOCUMENT_ROOT'].'/uploads/metaDonnees/'.$bookmarkFileName.' output '.$_SERVER['DOCUMENT_ROOT'].'/uploads/integrationPdf/'.$pdfGeneratedFileName);
                
            }
            else {

                shell_exec('pdftk '.$_SERVER['DOCUMENT_ROOT'].'/uploads/sourcePdf/'.$pdfFileName.' update_info '.$_SERVER['DOCUMENT_ROOT'].'/uploads/metaDonnees/'.$bookmarkFileName.' output '.$_SERVER['DOCUMENT_ROOT'].'/uploads/sourcePdfSummary/[Summary]'.$pdfFileName);
                
                self::AddCoverPageToPdf($coverPageFilePath, $pdfFileName, $pdfGeneratedFileName);
                
            }

            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/metaDonnees/'.$bookmarkFileName);

            return $pdfGeneratedFileName;
        }

        //4
        public static function IntegrationPdf($csvFileName, $pdfFileName, $coverPageFileName=null){

            $csvFilePath = './uploads/csv/'.$csvFileName;
            $csvDataArray = self::csvStringToArray(file_get_contents($csvFilePath));

            if($coverPageFileName == null) {
                
                $pdfGeneratedFileName = self::ConvertPdfFile($csvDataArray, $pdfFileName, null);
            }
            else {
                $pdfGeneratedFileName = self::ConvertPdfFile($csvDataArray, $pdfFileName, $coverPageFileName);
            }

            return $pdfGeneratedFileName;
        }

        public static function csvStringToArray($string, $separatorChar = ';', $enclosureChar = '"', $newlineChar = "\n") {
            $array = array();
            $size = strlen($string);
            $columnIndex = 0;
            $rowIndex = 0;
            $fieldValue="";
            $isEnclosured = false;
            for($i=0; $i<$size;$i++) {
        
                $char = $string[$i];
                $addChar = "";
        
                if($isEnclosured) {
                    if($char==$enclosureChar) {
        
                        if($i+1<$size && $string[$i+1]==$enclosureChar){
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
        
            if($fieldValue) { 
                $array[$rowIndex][$columnIndex] = $fieldValue;
            }
            return $array;
        }

        //3 a fixer ?
        public static function AddCoverPageToPdf($coverPageFilePath, $pdfFileName, $pdfGeneratedFileName){
            shell_exec('pdftk '.$_SERVER['DOCUMENT_ROOT'].'/'.$coverPageFilePath.' '.$_SERVER['DOCUMENT_ROOT'].'/uploads/sourcePdfSummary/[Summary]'.$pdfFileName.' cat output '.$_SERVER['DOCUMENT_ROOT'].'/uploads/integrationPdf/'.$pdfGeneratedFileName);
        
            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/sourcePdfSummary/[Summary]'.$pdfFileName);
        }
    
        //$emplacementPageDeGarde = uploads/pageDeGarde/..et new function name pour $coverPageFilePath.
        public static function ConvertCoverPageFilePath($text, $emplacementPageDeGarde, $libelle) {
            $coverPageFileName = str_replace('uploads/pageDeGarde/', '', $emplacementPageDeGarde);
            $coverPageFilePath = 'uploads/pageDeGardeWText/'.$coverPageFileName;


            shell_exec('convert -density 288 -gravity Center -font Gotham-Bold '.$_SERVER['DOCUMENT_ROOT'].'/'.$emplacementPageDeGarde.' -pointsize 40 -fill white -annotate +0+1075 '.$libelle.' -gravity west -pointsize 21 -fill white -annotate +40+1370 '. escapeshellarg($text) .' '.$_SERVER['DOCUMENT_ROOT'].'/'.$coverPageFilePath);
            return $coverPageFilePath;
        }

}