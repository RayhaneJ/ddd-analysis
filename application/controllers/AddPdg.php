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

                $config['upload_path']="./uploads/pageDeGarde";
                $config['allowed_types']='pdf';
         
                $this->load->library('upload',$config);
                if($this->upload->do_upload("file")){

                        $data = array('upload_data' => $this->upload->data());
 
                        $libelle= $this->input->post('title');
                        $file= $data['upload_data']['file_name']; 
                        $emplacementPdg = "uploads/pageDeGarde/".$file;

                        $this->dataaccess::InsertPdgInDb($emplacementPdg, $libelle);
                }
        }
}
        

