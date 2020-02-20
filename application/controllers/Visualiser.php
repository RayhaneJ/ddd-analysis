<?php 
class Visualiser extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();
        $this->load->library('dataaccess');
        $this->load->library('manipulationslides');
    }

    public function index() {
        // $this->load->view('slideView');
    }

    //tout les codes baps sont differents
    public function Slides($codeBaps, $codeRayhane = null) {
        if($codeRayhane == null){
            $emplacement = $this->dataaccess::GetEmplacementForPdfFiles($codeBaps);

            if($emplacement == null){
                $data['erreur'] = "Impossible d'accéder au diaporama, veuillez réessayer plus tard.";
                $this->load->view('errorView', $data);
            }

            else{
                $files = $this->manipulationslides::GetFiles($emplacement);
                
                $data['emplacement'] = $emplacement;
                $data['files'] = $files;
                $this->load->view('slideView', $data); 
            }
        }
        else {
            $emplacement = $this->dataaccess::GetEmplacementForPdfFiles($codeBaps, $codeRayhane);

            if($emplacement == null){
                $data['erreur'] = "Impossible d'accéder au diaporama, veuillez réessayer plus tard.";
                $this->load->view('errorView', $data);
            }
            else {
                $files = $this->manipulationslides::GetFiles($emplacement);

                $data['emplacementPdf'] = $emplacement;
                $data['files'] = $files;
                
                $this->load->view('slideView', $data);
            }
        }
    }
}