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

    public static function formInsert($libelleCours, $libCodeBaps, $libCodeRayhane) {
        $CI =& get_instance();
        $sql = 'call formInsertCode(?, ?, ?)';
        $param = array($libelleCours, $libCodeBaps, $libCodeRayhane);
        $CI->db->query($sql, $param);
    }

    public static function formInsertFiles($libelleCoursSource, $emplacementCoursSource, $emplacementSlide, $libelleSupportCoursGen, $emplacementSupportCoursGen, $libCodeBaps, $libCodeRayhane, $csv) {
        $CI =& get_instance();

        $sql = 'call formInsertFiles(?, ?, ?, ?, ?, ?, ?, ?)';
        $param = array($libelleCoursSource, $emplacementCoursSource, $emplacementSlide, $libelleSupportCoursGen, $emplacementSupportCoursGen, $libCodeBaps, $libCodeRayhane, $csv);

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


    public static function GetPageDeGarde($libellePdg){
        $CI = & get_instance();
        $CI->db->select('emplacement');
        $CI->db->from('stockerPageDeGarde');
        $CI->db->where('libelle', $libellePdg);
        // $result = $CI->db->get()->result_array();
        // foreach($result as $libellePdg =>$value) {
        //     foreach($value as $key) {
        //         $emplacement = $key;
        //     }
        // }
        // return $emplacement;
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
        // if($query->num_row()>0){
        //     $result = $CI->db->get()->result_array();
        // }
        // else {
        //     $result = null;
        // }

        // return $result;
    }
}

    





    