<?php
class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->database();
                $this->load->library('dataaccess');
                $this->load->library('manipulationpdf'); 
                $this->load->library('manipulationslides'); 
                $this->load->helper('download');  
                           
        }

        public function index()
        {
                $data['libelle'] = $this->dataaccess::getAllPdgInDb(); 
                $this->load->view('upload_form', $data);
        }
        
        public function doUpload() {

                $fileUploadHasError = false;

                if (!empty($_FILES)) 
		{
                        $filesCount = count($_FILES['file']['name']);

                        for ($i = 0; $i < $filesCount; $i++) {
                                
                                $_FILES['uploadFile']['name'] = str_replace(",","_",$_FILES['file']['name'][$i]);
                                $_FILES['uploadFile']['type'] = $_FILES['file']['type'][$i];
                                $_FILES['uploadFile']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                                $_FILES['uploadFile']['error'] = $_FILES['file']['error'][$i];
                                $_FILES['uploadFile']['size'] = $_FILES['file']['size'][$i];

                                setlocale(LC_ALL,'en_US.UTF-8');
                                $extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);
                                
                                if($extension == "pdf"){
                                        $uploadPath = "./uploads/sourcePdf";
                                }
                                else {
                                        if($extension == "zip"){
                                                $uploadPath = "./uploads/sourcesSlides";
                                        }
                                        else {
                                                if($extension == "csv"){
                                                        $uploadPath = "./uploads/csv";
                                                }
                                        }
                                }
                                
                                $config = [];
                                $config['upload_path'] = $uploadPath;
                                // Specifying the file formats that are supported.
                                $config['allowed_types'] = '*';
                                
                                $fileName = $_FILES['uploadFile']['name'];
                                $config['file_name'] = date('YmdHis') . '_' . rand(1, 1000) . $fileName; //renommage du fichier
                                
                                $this->load->library('upload', $config);
                                $this->upload->initialize($config);
                                
                                //Si l'upload se déroule bien alors on poursuit 
                                if ($this->upload->do_upload('uploadFile')) {
                                        $fileData = $this->upload->data();
                                        
                                        $extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);
                                        
                                        if($extension == "pdf"){
                                                $pdfFileName = $fileData['file_name'];
                                        }
                                        else {
                                                if($extension == "zip"){
                                                        $slideFileName = $fileData['file_name'];
                                                }
                                                else {
                                                        if($extension == "csv"){
                                                                $csvFileName = $fileData['file_name'];
                                                        }
                                                }
                                        }
                                }
                                else {
                                        $fileUploadHasError = true;
                                        break;
                                }
                        }

                        if($fileUploadHasError == false){

                                //On recupere le reste des inputs de notre formulaire
                                $codeRayhane = $this->input->post('codeRayhane');
                                $pageDeGarde = $this->input->post('pageDeGarde');
                                $typeSupport = $this->input->post('typeSupport');
                                $codeBaps = $this->input->post('codeBaps');
                                $libelleCours = $this->input->post('libelleCours');
                                
                                //On constitue l'emplacement des chemins d'uploads
                                $pdfFilePath = 'uploads/sourcePdf/'.$pdfFileName;
                                $slideFilePath = 'uploads/sourcesSlides/'.$slideFileName;
                                $csvFilePath = 'uploads/csv/'.$csvFileName;
                                
                                //On regarde dans la base de données si ce code baps est déja pris 
                                if($this->dataaccess::CheckIfSlideExistInDb($codeBaps, $codeRayhane) != true){
                                        
                                        //Add summary to page de garde and title
                                        if($pageDeGarde == "Pages de garde") {
                                                $pdfFileGenerated = $this->manipulationpdf::IntegrationPdf($csvFileName, $pdfFileName);
                                        }
                                        
                                        else {
                                                $coverPageFilePath = $this->dataaccess::GetPageDeGarde($pageDeGarde);
                                                
                                                if($typeSupport == "0"){
                                                        $pdfFileGenerated = $this->manipulationpdf::IntegrationPdf($csvFileName, $pdfFileName, $coverPageFilePath);
                                                        
                                                }
                                                else {
                                                        if($typeSupport == "1") {
                                                                $text = "Support de cours";
                                                                $customCoverPageCreatedFilePath = $this->manipulationpdf::ConvertCoverPageFilePath($text, $coverPageFilePath, $libelleCours);
                                                                $pdfFileGenerated = $this->manipulationpdf::IntegrationPdf($csvFileName, $pdfFileName, $customCoverPageCreatedFilePath); 
                                                        }
                                                        else {
                                                                if($typeSupport == "2") {
                                                                        $text = "Cahier d'exercice";
                                                                        $customCoverPageCreatedFilePath = $this->manipulationpdf::ConvertCoverPageFilePath($text, $coverPageFilePath, $libelleCours);
                                                                        $pdfFileGenerated = $this->manipulationpdf::IntegrationPdf($csvFileName, $pdfFileName, $customCoverPageCreatedFilePath);
                                                                }
                                                                else {
                                                                }
                                                                
                                                        }
                                                        unlink($_SERVER['DOCUMENT_ROOT'].'/'.$customCoverPageCreatedFilePath);
                                                }
                                        }
                                        
                                        //Prepare files Name For Insert in db
                                        $pdfFileGeneratedFilePath = 'uploads/integrationPdf/'.$pdfFileGenerated;
                                        
                                        //On extrait le file zip pour le slideshow
                                        $newFolderSlideNameExtracted = $this->manipulationslides::ExtractZip($slideFilePath);
                                        $newPathFolderSlideNameExtracted = "uploads/sourcesSlides/".$newFolderSlideNameExtracted;
                                        
                                        //On fait les insert dans la bdd
                                        $StoredProcedureCourseCodeResult = $this->dataaccess::formInsert($codeBaps, $codeRayhane);
                                        $StoredProcedureFilesResult = $this->dataaccess::FormInsertFiles($pdfFilePath, $newPathFolderSlideNameExtracted, $pdfFileGeneratedFilePath, $codeBaps, $codeRayhane, $csvFilePath);
                                        
                                        //Supprime les fichiers qui ne vont plus servir
                                        unlink($pdfFilePath);

                                        $path = $_SERVER['DOCUMENT_ROOT'].'/uploads/sourcesSlides/'.$newFolderSlideNameExtracted;

                                        do {
                                                if (file_exists($path)) {
                                                        $files = array_diff(scandir($path), array('.', '..'));
                                                        natsort($files);
                
                                                        $folderName = date('YmdHis') . '_' . rand(1, 1000).$newFolderSlideNameExtracted."Thumbnails";
                
                                                        $pathFolderName = "/var/www/eSLIDES/uploads/thumbnails/".$folderName;
                                                        mkdir($pathFolderName,0775, TRUE);
                
                                                        $i=0;
                                                        foreach($files as $file) {
                                                        shell_exec("convert /var/www/eSLIDES/uploads/sourcesSlides/".$newFolderSlideNameExtracted."/".$file." -trim -resize 300x300 ".$pathFolderName."/thumbnail".$i.".png");                                                                    
                                                        $i++;
                                                        }
                
                                                        $emplacementThumbnailsCreated = "uploads/thumbnails/".$folderName;
                                                        
                                                        $this->dataaccess::InsertThumbnailsInDb($emplacementThumbnailsCreated);
                                                        $this->dataaccess::InsertThumbnailsInSlide($codeBaps, $codeRayhane, $emplacementThumbnailsCreated);
                                                }
                                            } while(!file_exists($path));

                                            shell_exec("gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/screen -dNOPAUSE -dQUIET -dBATCH -sOutputFile=".$_SERVER['DOCUMENT_ROOT']."/".$pdfFileGeneratedFilePath." ".$_SERVER['DOCUMENT_ROOT']."/".$pdfFileGeneratedFilePath);
                                            
                                            echo json_encode($pdfFileGenerated);
                                }
                                
                                else {
                                        //Delete files uploads if errors raise
                                        unlink($pdfFilePath);
                                        unlink($slideFilePath);
                                        unlink($csvFilePath);
                                        
                                        $arr = array('status' => "codeBapsError");
                                        
                                        header('Content-Type: application/json');
                                        echo json_encode($arr);
                                }
                        }
                        else {
                                //Delete files uploads if errors raise
                                unlink($pdfFilePath);
                                unlink($slideFilePath);
                                unlink($csvFilePath);
                                
                                $arr = array('error' => "errorFileUpload");
                                
                                echo json_encode($arr);
                        } 
                }       
        }                
                  

        public function GestionPdg(){
                $data['libelle'] = $this->dataaccess::getAllPdgInDb();
                $this->load->view('gestionPdg', $data);
        }


        public function LoadPdfPage($libellePdg){
                $emplacement = $this->dataaccess::GetPageDeGarde($libellePdg);
                echo json_encode($emplacement);
        }

        public function SupprimerPdg($libelle) {
                $emplacement = $this->dataaccess::GetPageDeGarde($libelle);
                unlink($_SERVER['DOCUMENT_ROOT'].'/'.$emplacement);

                $this->dataaccess::pdgDelete($libelle);
        }

        public function LoadSuccessView() {
                $this->load->view('downloadView');
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
