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
                $this->load->library('form_validation');
                $this->form_validation->set_rules('codeBaps', 'CodeBaps', 'required');
                $this->form_validation->set_rules('libelleCours', 'LibelleCours', 'required');

                if($this->form_validation->run() == FALSE) {
                        $this->load->view('upload_form');
                }

                else {                

                                $fieldName = 'fichiers';//nom du champ input file
                                //ce champs doit exister et avoir un élément "name" sous forme de tableau
                                if ($_FILES && isset($_FILES[$fieldName]) && is_array($_FILES[$fieldName]['name']) && count($_FILES[$fieldName]['name']) == 3) {
                                        $i=0;
                                        //dans ce cas on boucle sur chaque élément du tableau qui ne peut contenir que 3 élément
                                        foreach ($_FILES[$fieldName]['name'] as $key => $name) {
                                                
                                                $dest='';
                                                $filtre='';
                                                if ($name) {
                
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
                                                        $_FILES['file_temp']['name'] = $_FILES[$fieldName]['name'][$key];
                                                        $_FILES['file_temp']['type'] = $_FILES[$fieldName]['type'][$key];
                                                        $_FILES['file_temp']['tmp_name'] = $_FILES[$fieldName]['tmp_name'][$key];
                                                        $_FILES['file_temp']['error'] = $_FILES[$fieldName]['error'][$key];
                                                        $_FILES['file_temp']['size'] = $_FILES[$fieldName]['size'][$key];
                
                                                        //on met en place la configuration pour l'upload du fichier, comme on l'aurait pour n'importe quel input file sous codeigniter
                                                        $config = [];
                                                        $config['upload_path'] = $dest;//dossier d'upload
                                                        $config['allowed_types'] = $filtre;//types de fichiers autorisé
                                                        $fileName = $_FILES[$fieldName]['name'][$key];
                                                        $config['file_name'] =  date('YmdHis') . '_' . rand(1, 1000) . $fileName;//renommage du fichier
                
                                                        //ligne les plus importantes : ne fonctionnera pas avec l'habituel "$this->load->library('upload', $config);"
                                                        $this->load->library('upload');
                                                        $this->upload->initialize($config);
                
                                                        //on traite notre fichier dans "file_temp" et on vérifie si il y'a des erreurs.
                                                        if (!$this->upload->do_upload('file_temp')) {
                                                                $error = array('error' => $this->upload->display_errors());
                                                                break;
                                                                //$this->load->view('upload_form', $error);
                                                        } 
                                                        else {
                                                                //tout c'est bien passé vous pouvez récupérer les informations du fichiers de cette façon
                                                                $fichier = $this->upload->data();
                                                                echo $fichier['file_name'];
                                                                echo $fichier['full_path'];
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
                                        $i++;
                                        }
                                        $this->load->view('upload_form', $error);
   
                                        
                                }
                                else {
                                        if(count($_FILES['fichiers']) != 3) {

                                                $erreur = array('erreur'=> 'test');
                                                $this->load->view('upload_form', $erreur);
                                        }

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



}
