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

}