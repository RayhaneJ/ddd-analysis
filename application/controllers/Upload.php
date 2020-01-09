
<?php

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                
        }

        public function index()
        {
                $this->load->view('upload_form', array('error' => ' ' ));
        }

        public function do_upload()
        {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png|pdf';
                $config['max_size']             = 'none';
                $config['max_width']            = 'none';
                $config['max_height']           = 'none';

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('upload_form', $error);
                }
                else
                {       
                        $data = array('upload_data' => $this->upload->data());
                        $chapitres = $this->input->post('newInputBox');
                        $this->load->model('manipulationPdf_model');
                        $this->manipulationPdf_model::addSummaryToPdf($chapitres);
                        $this->load->view('upload_success', $data);
                        
                    //    shell_exec('pdftk /var/www/html/IntegrSupCours/uploads/GKAG01_FR.pdf dump_data output /var/www/html/IntegrSupCours/uploads/bookmark.txt');
                }
        }

}
