<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataaccess {

    private static $initialized = false;

    public static function intialize(){

        if (self::$initialized) {
            return;
        }
        self::$initialized = true;
    }

    public static function pdgDelete($libelle) {
        $CI = & get_instance();
        $CI->db->where('libelle', $libelle);
        $CI->db->delete('stockerPageDeGarde');
    }

    public static function formInsert($libCodeBaps, $libCodeRayhane) {
        $CI =& get_instance();
        $sql = 'call formInsertCode(?, ?)';
        $param = array($libCodeBaps, $libCodeRayhane);
        $CI->db->query($sql, $param);

        if(!$CI->db->query($sql, $param)){
            return false;
        }            
        else {
            return true;
        }
        
    }

    public static function formInsertFiles($emplacementCoursSource, $emplacementSlide, $emplacementSupportCoursGen, $libCodeBaps, $libCodeRayhane, $csv) {
        $CI =& get_instance();

        $sql = 'call formInsertFiles(?, ?, ?, ?, ?, ?)';
        $param = array($emplacementCoursSource, $emplacementSlide, $emplacementSupportCoursGen, $libCodeBaps, $libCodeRayhane, $csv);

        if(!$CI->db->query($sql, $param)){
            return false;
        }            
        else {
            return true;
        }
            
    }

    public static function InsertPdgInDb($emplacement, $libelle) {
        $CI = & get_instance();
        $sql = 'call insertPdg(?, ?)';
        $param = array($libelle, $emplacement);
        $CI->db->query($sql, $param);
    }

    public static function getAllPdgInDb() {
        $CI =& get_instance();
        $CI->db->select('libelle');
        $CI->db->from('stockerPageDeGarde');
        $result =$CI->db->get()->result_array();
        //on recupere les elements de la requete dans un tableau sans les clés array['libellePdg']
        $tableauPdg = array();
        foreach($result as $libellePdg => $value) {
            foreach($value as $key){
                $tableauPdg[] = $key;
            }
        }
        return $tableauPdg;

        
    }

    public static function CheckIfCoverPageExistInDb($libellePdg){
        $CI = &get_instance();

        $CI->db->where('libelle', $libellePdg);
        $query = $CI->db->get('stockerPageDeGarde');

        if ($query->num_rows() > 0){
        	return true;
        }
        else{
        	return false;
        }
    }


    public static function GetPageDeGarde($libellePdg){
        $CI = & get_instance();
        $CI->db->select('emplacement');
        $CI->db->from('stockerPageDeGarde');
        $libellePdg = urldecode($libellePdg);
        $CI->db->where('libelle', $libellePdg);

        $result = $CI->db->get()->row()->emplacement;

        return $result;
    }

    //Inutile
    public static function GetFolderNameForPdfFiles($codeBaps){
        $CI = &get_instance();
        $CI->db->select('libelle');
        $CI->db->from('slide');
        $CI->db->where('codeBaps', $codeBaps);

        $result = $CI->db->get()->row()->libelle;

        return $result;
    }

    public static function GetEmplacementForSlidesFiles($codeBaps, $codeRayhane=null) {
        $CI = &get_instance();

        if($codeRayhane == null){
            $CI->db->select('emplacementFichier');
            $CI->db->from('slide');
            $CI->db->where('codeBaps', $codeBaps);
        }
        else {
            $CI->db->select('emplacementFichier');
            $CI->db->from('slide');
            $CI->db->where('codeBaps', $codeBaps);
            $CI->db->where('codeRayhane', $codeRayhane);
        }

        $query = $CI->db->get();

        if($query->num_rows()>0){
            $result = $query->row()->emplacementFichier;
        }
        else {
            $result = null;
        }

        return $result;
    }

    public static function GetEmplacementCsv($codeBaps, $codeRayhane=null){
        $CI = &get_instance();

        if($codeRayhane == null){
            $CI->db->select('emplacementCsv');
            $CI->db->from('slide');
            $CI->db->where('codeBaps', $codeBaps);
        }

        else {
            $CI->db->select('emplacementCsv');
            $CI->db->from('slide');
            $CI->db->where('codeBaps', $codeBaps);
            $CI->db->where('codeRayhane', $codeRayhane);
        }

        $query = $CI->db->get();

        if($query->num_rows()>0){
            $result = $query->row()->emplacementCsv;
        }
        else {
            $result = null;
        }

        return $result;
    }

    public static function InsertThumbnailsInDb($emplacement){
        
        $CI = &get_instance();
        $data = array(
            'emplacement'=> $emplacement
        );

        $CI->db->insert('thumbnails', $data);
    }

    public static function InsertThumbnailsInSlide($codeBaps, $codeRayhane = null, $thumbnails) {
        $CI = &get_instance();

        if($codeRayhane == null){
            $data = array(
                'emplacementThumbnails'=> $thumbnails
            );
            $CI->db->where('codeBaps', $codeBaps);
            $CI->db->where('codeRayhane', $codeRayhane);
            $CI->db->update('slide', $data);
        }
        else {
            $data = array(
                'emplacementThumbnails' => $thumbnails
            );
            $CI->db->where('codeBaps', $codeBaps);
            $CI->db->where('codeRayhane', $codeRayhane);
            $CI->db->update('slide', $data);
        }
    }

    public static function GetEmplacementThumbnailsFolder($codeBaps, $codeRayhane=null){
        $CI = &get_instance();

        if($codeRayhane == null) {
            $CI->db->select('emplacementThumbnails');
            $CI->db->from('slide');
            $CI->db->where('codeBaps', $codeBaps);
        }

        else {
            $CI->db->select('emplacementThumbnails');
            $CI->db->from('slide');
            $CI->db->where('codeBaps', $codeBaps);
            $CI->db->where('codeRayhane', $codeRayhane);
        }

        $query = $CI->db->get();

        if($query->num_rows()>0){
            $result = $query->row()->emplacementThumbnails;
        }
        else {
            $result = null;
        }

        return $result;
    }
    
    public static function GetAllSlides(){
        $CI = &get_instance();

        $CI->db->select('id, dateInjection, dateDerniereModification, codeBaps, codeRayhane');

        $query = $CI->db->get('slide')->result_array();

        return $query;
    }

    public static function DeleteSlide($id){
        $CI = &get_instance();

        $CI->db->delete('slide', array('id' =>$id));
    }

    public static function GetEmplacementSlide($id){
        $CI = &get_instance();

            $CI->db->select('emplacementFichier');
            $CI->db->from('slide');
            $CI->db->where('id', $id);

        $query = $CI->db->get();

        if($query->num_rows()>0){
            $result = $query->row()->emplacementFichier;
        }
        else {
            $result = null;
        }

        return $result;
    }

    public static function SupportCoursSourceUpdateToNull($emplacement){
        $CI = &get_instance();

        $data = array(
            'slide' => null
        );

        $CI->db->where('slide', $emplacement);
        $CI->db->update('supportCoursSource', $data);
    }
    
    public static function SupportCoursGenUpdateToNull($emplacement){
        $CI = &get_instance();

        $data = array(
            'slide' => null
        );

        $CI->db->where('slide', $emplacement);
        $CI->db->update('supportCoursGen', $data);
    }

    public static function SupportCoursGenUpdate($emplacement, $newSlide){
        $CI = &get_instance();

        $data = array(
            'slide' => $newSlide
        );

        $CI->db->where('slide', $emplacement);
        $CI->db->update('supportCoursGen', $data);
    }

    public static function SupportCoursSourceUpdate($emplacement, $newSlide){
        $CI = &get_instance();

        $data = array(
            'slide' => $newSlide
        );

        $CI->db->where('slide', $emplacement);
        $CI->db->update('supportCoursSource', $data);
    }

    public static function GetEmplacementThumbnailsById($id){
        $CI=&get_instance();

        $CI->db->select('emplacementThumbnails');
        $CI->db->from('slide');
        $CI->db->where('id', $id);

        $query = $CI->db->get()->row()->emplacementThumbnails;

        return $query;
    }
    public static function UpdateSlide($emplacement, $newSlide, $newCsv){
        $CI=&get_instance();

        $data = array(
            'emplacementFichier' => $newSlide,
            'emplacementCsv' => $newCsv,
        );

        $CI->db->where('emplacementFichier', $emplacement);
        $CI->db->update('slide', $data);
    }

    public static function DeleteThumbnailsRow($emplacement){
        $CI = &get_instance();

        $CI->db->delete('thumbnails', array('emplacement' => $emplacement));
    }

    public static function updateTumbnailsInSlide($id, $emplacementThumbnailsCreated){
        $CI = &get_instance();

        $data = array(
            'emplacementThumbnails'=> $emplacementThumbnailsCreated
        );
        
        $CI->db->where('id', $id);
        $CI->db->update('slide', $data);
    }

    public static function InsertInCsvTable($emplacement){
        $CI = &get_instance();

        $data = array(
            'emplacement'=> $emplacement
        );

        $CI->db->insert('csv', $data);
    }

    public static function GetAllSupport(){

        $CI = &get_instance();

        $CI->db->select('id, dateGeneration, derniereModification, emplacement,  codeBaps, codeRayhane');
        $query = $CI->db->get('supportCoursGen')->result_array();

        return $query;
    }
    
    public static function CheckIfSlideExistInDb($codeBaps, $codeRayhane){
        $CI = &get_instance();

        $CI->db->where('codeBaps',$codeBaps);
        $CI->db->where('codeRayhane',$codeRayhane);
        $query = $CI->db->get('slide');

        if ($query->num_rows() > 0){
        	return true;
        }
        else{
        	return false;
        }
    }

}

    





    
