<?php 
class Visualiser extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();
        $this->load->library('dataaccess');
        $this->load->library('manipulationslides');
        $this->load->library('manipulationpdf');
    }

    public function index() {
        $slides = $this->dataaccess::GetAllSlides();

        $data['slides'] = $slides;
        $this->load->view('mainMenuSlides', $data);
    }

    //tout les codes baps sont differents
    public function Slides($codeBaps, $codeRayhane = null) {
        if($codeRayhane == null){
            $emplacementSlides = $this->dataaccess::GetEmplacementForSlidesFiles($codeBaps);
            $csvEmplacement = $this->dataaccess::GetEmplacementCsv($codeBaps);
            $thumbnailsEmplacement = $this->dataaccess::GetEmplacementThumbnailsFolder($codeBaps, $codeRayhane);
            $thumbnailsFiles = $this->manipulationslides::GetFiles($thumbnailsEmplacement);
            
            $sommaire = $this->manipulationpdf::csvStringToArray(file_get_contents($csvEmplacement));

            if($emplacementSlides == null || $csvEmplacement==null){
                $data['erreur'] = "Le diaporama n'est pas disponible actuellement ou alors il n'existe pas, veuillez réessayer plus tard.";
                $this->load->view('errorView', $data);
            }

            else{
                $files = $this->manipulationslides::GetFiles($emplacementSlides);
                
                $data['emplacementSlides'] = $emplacementSlides;
                $data['files'] = $files;
                $data['sommaire'] = $sommaire;
                $data['emplacementThumbnails'] = $thumbnailsEmplacement;
                $data['thumbnailsFiles'] = $thumbnailsFiles;

                $this->load->view('slideView', $data); 
            }
        }
        else {
            $emplacementSlides = $this->dataaccess::GetEmplacementForPdfFiles($codeBaps, $codeRayhane);
            $csvEmplacement = $this->dataaccess::GetEmplacementCsv($codeBaps, $codeRayhane);
            $thumbnails = $this->dataaccess::GetEmplacementThumbnailsFolder($codeBaps, $codeRayhane);
            $thumbnailsFiles = $this->manipulationslides::GetFiles($thumbnails);

            $sommaire =  $this->manipulationpdf::csvStringToArray(file_get_contents($csvEmplacement));

            if($emplacementSlides == null || $csvEmplacement == null){
                $data['erreur'] = "Le diaporama n'est pas disponible actuellement ou alors il n'existe pas, veuillez réessayer plus tard.";
                $this->load->view('errorView', $data);
            }
            else {
                $files = $this->manipulationslides::GetFiles($emplacementSlides);

                $data['emplacementSlides'] = $emplacementSlides;
                $data['files'] = $files;
                $data['sommaire'] = $sommaire;
                $data['emplacementThumbnails'] = $thumbnailsEmplacement;
                $data['thumbnailsFiles'] = $thumbnailsFiles;

                $this->load->view('slideView', $data);
            }
        }
    }

    public function DeleteSlide($id){
        $emplacementSlide = $this->dataaccess::GetEmplacementSlide($id);
        $emplacementThumbnails = $this->dataaccess::GetEmplacementThumbnailsById($id);

        $files = glob($_SERVER['DOCUMENT_ROOT'].'/SiteWebIntegrationWeb/'.$emplacementSlide."/*"); 
        foreach($files as $file){ // iterate files
                if(is_file($file))
                unlink($file); // delete file
        }

        rmdir($_SERVER['DOCUMENT_ROOT'].'/SiteWebIntegrationWeb/'.$emplacementSlide);

        $files = glob($_SERVER['DOCUMENT_ROOT'].'/SiteWebIntegrationWeb/'.$emplacementThumbnails."/*"); 
        foreach($files as $file){ 
                if(is_file($file))
                unlink($file); 
        }

        rmdir($_SERVER['DOCUMENT_ROOT'].'/SiteWebIntegrationWeb/'.$emplacementThumbnails);

        $this->dataaccess::SupportCoursGenUpdateToNull($emplacementSlide);
        $this->dataaccess::SupportCoursSourceUpdateToNull($emplacementSlide);
        
        $this->dataaccess::DeleteSlide($id);
}


    public function  ChangerSlide($id){
        $emplacementSlide = $this->dataaccess::GetEmplacementSlide($id);
        $emplacementThumbnails = $this->dataaccess::GetEmplacementThumbnailsById($id);

        $files = glob($_SERVER['DOCUMENT_ROOT'].'/SiteWebIntegrationWeb/'.$emplacementSlide."/*"); 
        foreach($files as $file){ // iterate files
                if(is_file($file))
                unlink($file); // delete file
        }

        rmdir($_SERVER['DOCUMENT_ROOT'].'/SiteWebIntegrationWeb/'.$emplacementSlide);

        $files = glob($_SERVER['DOCUMENT_ROOT'].'/SiteWebIntegrationWeb/'.$emplacementThumbnails."/*"); 
        foreach($files as $file){ 
                if(is_file($file))
                unlink($file); 
        }

        rmdir($_SERVER['DOCUMENT_ROOT'].'/SiteWebIntegrationWeb/'.$emplacementThumbnails);

        for($i = 0; $i < 2; $i++) {
                                                
            $dest='';
            $filtre='';

            switch($i) 
                    {                   
                    case 0:
                            $dest="./uploads/sourcesSlides";
                            $filtre ='zip';
                            break;
                    case 1:
                            $dest="./uploads/csv";
                            $filtre ='csv';
                            break;
                    default :
                            break;
            }
                                    
            //on copie les variables de l'élément courant dans le tableau $_FILES avec comme nom arbitraire "file_temp". Cela permettra à codeigniter de le traiter comme un champ file simple.
            $_FILES['file_temp']['name'] = $_FILES['fichiers']['name'][$i];
            $_FILES['file_temp']['type'] = $_FILES['fichiers']['type'][$i];
            $_FILES['file_temp']['tmp_name'] = $_FILES['fichiers']['tmp_name'][$i];
            $_FILES['file_temp']['error'] = $_FILES['fichiers']['error'][$i];
            $_FILES['file_temp']['size'] = $_FILES['fichiers']['size'][$i];

            //on met en place la configuration pour l'upload du fichier, comme on l'aurait pour n'importe quel input file sous codeigniter
            $config = [];
            $config['upload_path'] = $dest;//dossier d'upload
            $config['allowed_types'] = $filtre;//types de fichiers autorisé
            $fileName = $_FILES['fichiers']['name'][$i];
            $config['file_name'] =  date('YmdHis') . '_' . rand(1, 1000) . $fileName;//renommage du fichier

            //ligne les plus importantes : ne fonctionnera pas avec l'habituel "$this->load->library('upload', $config);"
            $this->load->library('upload');
            $this->upload->initialize($config);

            //on traite notre fichier dans "file_temp" et on vérifie si il y'a des erreurs.
            if (!$this->upload->do_upload('file_temp')) {

            } 
            else {
                    //tout c'est bien passé vous pouvez récupérer les informations du fichiers de cette façon
                    $fichier = $this->upload->data();
                    //$fichier['client_name'] -> nom d'origine du fichier
                    //traiter la réussite pour ce fichier comme il vous convient.

                    switch ($i) 
                    {
                            case 0:
                                    $currentSlideName = $fichier['file_name'];
                                    break;
                            case 1:
                                    $currentCsvName = $fichier['file_name'];
                                    break;
                            default:
                                    break;
                    }
            }

            $emplacementCsv = 'uploads/csv/'.$currentCsvName;

            $emplacementSlideSource = 'uploads/sourcesSlides/'.$currentSlideName;
            $folderNameSlide = $this->manipulationslides::ExtractZip($emplacementSlideSource);
            $emplacementSlideNew = "uploads/sourcesSlides/".$folderNameSlide;

            $this->dataaccess::SupportCoursGenUpdateToNull($emplacementSlide);
            $this->dataaccess::SupportCoursSourceUpdateToNull($emplacementSlide);

            $this->dataaccess::UpdateSlide($emplacementSlide, $emplacementSlideNew, $emplacementCsv);

            $emplacementThumbnailsCreated = shell_exec('php '.$_SERVER['DOCUMENT_ROOT']."/SiteWebIntegrationWeb/script/Thumbnails.php ".$emplacementSlideNew);

            $this->dataaccess::InsertThumbnailsInDb($emplacementThumbnailsCreated);
            $this->dataaccess::InsertThumbnailsInSlide($id, $emplacementThumbnailsCreated);
        }
        }
    }

