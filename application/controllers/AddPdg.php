<?php
class AddPdg extends CI_Controller {
        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->database();
                $this->load->library('dataaccess'); 
                $this->load->library('form_validation');
                           
        }

        public function index()
        {

        }

        public function AddNewPageDeGarde(){

                $libelle= $this->input->post('libellePdg');

                if($this->dataaccess::CheckIfCoverPageExistInDb($libelle) != true) {
                        $config['upload_path']="./uploads/pageDeGarde";
                        $config['allowed_types']='pdf';
                        $config['file_name'] = date('YmdHis') . '_' . rand(1, 1000) ."pageDeGarde.pdf"; //renommage du fichier
                        $fileName = $config['file_name'];
                 
                        $this->load->library('upload',$config);
                        if($this->upload->do_upload("file")){
        
                                $data = array('upload_data' => $this->upload->data());

                                $emplacementPdg = "uploads/pageDeGarde/".$fileName;
        
                                $this->dataaccess::InsertPdgInDb($emplacementPdg, $libelle);

                                echo json_encode("success");
                        }
                }
                else {
                        echo json_encode("erreur");
                }
        }  
        
        // public function ChangeCoverPage(){

        //         $coverPageFileName= $this->input->post('pageDeGarde');

        //         $files = glob($_SERVER['DOCUMENT_ROOT'].'/uploads/integrationPdf/*.{pdf}', GLOB_BRACE);
        //         foreach($files as $file) {
        //                 shell_exec('pdftk A='.$_SERVER['DOCUMENT_ROOT'].'/uploads/integrationPdf/'.$file.' B='$_SERVER['DOCUMENT_ROOT'].'/uploads/pageDeGarde/'.$coverPageFileName.' cat B1 A2-end output '.$_SERVER['DOCUMENT_ROOT'].'/uploads/integrationPdf/'.$file);
        //         );
        //         }


        // }
}
        

