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

    }

    //tout les codes baps sont differents
    public function Slides($codeBaps) {
        $folderNameZip = $this->dataaccess::GetFolderNameForZipFiles($codeBaps);
        $pathInfo = pathinfo($_SERVER['DOCUMENT_ROOT'].'/IntegrSupCours/uploads/sourceSlides/'.$folderNameZip);
        $fileName = $pathInfo['filename'];

        $data['emplacementArray'] = $this->manipulationslides::GetJpgEmplacement($fileName);

        


    }
}