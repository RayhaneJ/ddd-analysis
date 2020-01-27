<?php
class Upload extends CI_Controller {
        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->database();
                $this->load->library('dataaccess');
                $this->load->library('manipulationpdf');                
        }

        public function index()
        {
                $data['libelle'] = $this->dataaccess::getAllPdg();
                $this->load->view('upload_form', $data);
        }
        
        public function doUpload() {
                
                $this->load->library('form_validation');
                $this->form_validation->set_rules('codeBaps', 'CodeBaps', 'required');
                $this->form_validation->set_rules('libelleCours', 'LibelleCours', 'required');
                //nom du champ input file
                $fileName = "fichiers";

                if($this->form_validation->run() == FALSE || $this->UploadArrayIsValid($fileName) == FALSE) {
                        $data['isMissing'] = $this->FormInputFileMissing($fileName);
                        $this->load->view('upload_form', $data);
                }

                else {                   
                        $errorFile = array();
                        $inputFileName = array();
                        //dans ce cas on boucle sur chaque élément du tableau qui ne peut contenir que 3 élément
                        for($i = 0; $i <= 2; $i++) {
                                                
                                $dest='';
                                $filtre='';
                
                                switch($i) 
                                        {                   

                                        case 0:
                                                $dest="./uploads/sourcePdf";
                                                $filtre ='pdf';
                                                break;
                                        case 1:
                                                $dest="./uploads/sourceSlide";
                                                $filtre ='zip';
                                                break;
                                        case 2:
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
                                        $errorFile[$i] =  TRUE;                                                                 
                                } 
                                else {
                                        //tout c'est bien passé vous pouvez récupérer les informations du fichiers de cette façon
                                        $fichier = $this->upload->data();
                                        $errorFile[$i] = FALSE;
                                        //$fichier['client_name'] -> nom d'origine du fichier
                                        //traiter la réussite pour ce fichier comme il vous convient.
                
                                        // switch ($fichier['file_type']) 
                                        // {
                                        //         case 'text/plain':
                                        //                 $currentCsvName = $fichier['file_name'];
                                        //                 break;
                                        //         case 'application/pdf':
                                        //                 $currentPdfName = $fichier['file_name'];
                                        //                 break;
                                        //         default:
                                        //                 break;
                                        // }
                                }
                        }

                        if($errorFile[0] == FALSE && $errorFile[1]==FALSE && $errorFile[2]==FALSE) {

                        }
                        else {
                                $data['errorFile'] = $errorFile;
                                $this->load->view('upload_form', $data);
                        }                                         
                }                    
        }
                
                                //$this->manipulationpdf::csvToPdfSummary($currentCsvName, $currentPdfName);
                                
                                // $libelleCours = $this->input->post('libelleCours');
                                // $this->dataaccess::coursInsert($libelleCours);
                
                                // $codeBaps = $this->input->post('codeBaps');
                                // $this->dataaccess::codeBapsInsert($codeBaps, $libelleCours);



        

        public function GestionPdg(){
                $data['libelle'] = $this->dataaccess::getAllPdg();
                $this->load->view('gestionPdg', $data);
        }

        public function UploadArrayIsValid($fileName) {
                if($_FILES[$fileName]['name'][0]!=null && $_FILES[$fileName]['name'][1]!=null && $_FILES[$fileName]['name'][2]!=null) {
                        return TRUE;
                }
                else {
                        return FALSE;
                }
        }

        public function FormInputFileMissing($fileName) {
                $isMissing = array();
                $i = 0;
                foreach ($_FILES[$fileName]['name'] as $key => $name) {
                        if($name == null) {
                                $isMissing[$i] = TRUE;
                        }
                        else {
                                $isMissing[$i] = FALSE;
                        }
                        $i++;
                }
                return $isMissing; 
        }



}
