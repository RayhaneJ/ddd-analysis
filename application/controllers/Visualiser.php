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
        $this->load->view('slideView');
    }

    //tout les codes baps sont differents
    public function Slides() {
        $this->load->view('t');
        // if(empty($codeRayhane)){
        //     $data['emplacementPdf'] = $this->dataaccess::GetEmplacementForPdfFiles($codeBaps);
        //     $this->load->view('slideView', $data);   
        // }
        // else {
        //     $data['emplacementPdf'] = $this->dataaccess::GetEmplacementForPdfFiles($codeBaps, $codeRayhane);
        //     $this->load->view('slideView', $data);
        // }
    }
}