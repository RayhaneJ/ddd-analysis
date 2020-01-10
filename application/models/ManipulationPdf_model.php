<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class manipulationPdf_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    public static function addSummaryToPdfBookmark($titreDesChapitres){
        shell_exec('pdftk '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/GKAG01_FR.pdf dump_data output '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/bookmark.txt');
        $file = $_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/bookmark.txt';
        $txt="";
        $i = 1;

        foreach($titreDesChapitres as $value){
            $txt.="BookmarkBegin\nBookmarkTitle: " . $value . " " . $i ."\nBookmarkLevel: " . $i ."\nBookmarkPageNumber: " . $i ."\n";
            $i++;
        }

        file_put_contents($file, $txt);
    }

    public static function addSummaryToPdf($titreDesChapitres) {
        self::addSummaryToPdfBookmark($titreDesChapitres);
        shell_exec('pdftk '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/GKAG01_FR.pdf update_info '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/bookmark.txt output '.$_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/bookmarked.pdf');
    }

    public static function addPdgToPdf($pdg){
        
    }

}
