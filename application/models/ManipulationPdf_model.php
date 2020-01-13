<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class manipulationPdf_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    public static function addSummaryToPdfBookmark($dataSummary, $pdfName){
        shell_exec('pdftk '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/sourcePdf/'.$pdfName.' dump_data output '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/metaDonnees/bookmark.txt');
        $file = $_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/metaDonnees/bookmark.txt';
        $txt="";

        foreach($dataSummary as $item => $value){
            $txt.="BookmarkBegin\nBookmarkTitle: " . $value[0] . "\nBookmarkLevel: 1\nBookmarkPageNumber: " . $value[1] ."\n";
        }

        file_put_contents($file, $txt);
    }

    //meilleure nom de fonctions possible
    public static function addSummaryToPdf($dataSummary, $pdfName) {
        self::addSummaryToPdfBookmark($dataSummary, $pdfName);
        shell_exec('pdftk '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/sourcePdf/'.$pdfName.' update_info '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/metaDonnees/bookmark.txt output '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/integrationPdf/bookmarked.pdf');
    }

    public static function csvToPdfSummary($csvName, $pdfName){
        $dataSummary = self::csvStringToArray(file_get_contents('./uploads/csv/'.$csvName));
        self::addSummaryToPdf($dataSummary, $pdfName);
    }


    public static function csvStringToArray($string, $separatorChar = ';', $enclosureChar = '"', $newlineChar = "\n") {
        // @author: Klemen Nagode
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
                        $i++; // dont check next char
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