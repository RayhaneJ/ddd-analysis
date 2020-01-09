<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class manipulationPdf_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    //lien du pdf a mettre en variable pour la commande shell
    public static function addSummaryToPdfBookmark($titreDesChapitres){
        shell_exec('pdftk /var/www/html/IntegrSupCours/uploads/GKAG01_FR.pdf dump_data output /var/www/html/IntegrSupCours/uploads/bookmark.txt');
        $file = "/var/www/html/IntegrSupCours/uploads/bookmark.txt";
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
        shell_exec('pdftk /var/www/html/IntegrSupCours/uploads/GKAG01_FR.pdf update_info /var/www/html/IntegrSupCours/uploads/bookmark.txt output /var/www/html/IntegrSupCours/uploads/bookmarked.pdf');
    }

}
