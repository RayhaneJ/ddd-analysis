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
        // $this->load->view('slideView');
    }

    //tout les codes baps sont differents
    public function Slides($codeBaps, $codeRayhane = null) {
        if($codeRayhane == null){
            $emplacement = $this->dataaccess::GetEmplacementForPdfFiles($codeBaps);
            $csvEmplacement = $this->dataaccess::GetEmplacementCsv($codeBaps);

            $sommaire = $this->manipulationpdf::csvStringToArray(file_get_contents($csvEmplacement));

            if($emplacement == null || $csvEmplacement==null){
                $data['erreur'] = "Impossible d'accéder au diaporama, veuillez réessayer plus tard.";
                $this->load->view('errorView', $data);
            }

            else{
                $files = $this->manipulationslides::GetFiles($emplacement);
                
                $data['emplacement'] = $emplacement;
                $data['files'] = $files;
                $data['sommaire'] = $sommaire;

                $this->load->view('slideView', $data); 
            }
        }
        else {
            $emplacement = $this->dataaccess::GetEmplacementForPdfFiles($codeBaps, $codeRayhane);
            $csvEmplacement = $this->dataaccess::GetEmplacementCsv($codeBaps, $codeRayhane);

            $sommaire =  $this->manipulationpdf::csvStringToArray(file_get_contents($csvEmplacement));

            if($emplacement == null || $csvEmplacement == null){
                $data['erreur'] = "Impossible d'accéder au diaporama, veuillez réessayer plus tard.";
                $this->load->view('errorView', $data);
            }
            else {
                $files = $this->manipulationslides::GetFiles($emplacement);

                $data['emplacementPdf'] = $emplacement;
                $data['files'] = $files;
                $data['sommaire'] = $sommaire;
                
                $this->load->view('slideView', $data);
            }
        }
    }
}