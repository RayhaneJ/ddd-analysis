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

    public static function coursInsert($libelle) {
        $CI =& get_instance();
        $sql = 'call coursInsert(?)';
        $CI->db->query($sql,$libelle);
    }

    public static function codeBapsInsert($codeBaps, $libelleCours) {
        $CI =& get_instance();
        $sql1 = 'call getIdCoursByLib(?, @output)';
        $CI->db->query($sql1, $libelleCours);
        //recupere output de la procedure
        $query = $CI->db->query(('select @output as output'));
        $result = $query->result_array();
        $idCours = $result[0]['output'];
        $sql2 = 'call codeBapsInsert(?, ?)';
        $CI->db->query($sql2,array($codeBaps, $idCours));
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


    public static function GetPageDeGardeToView($libellePdg){
        $CI = & get_instance();
        $CI->db->select('emplacement');
        $CI->db->from('stockerPageDeGarde');
        $CI->db->where('libelle', $libellePdg);
        $result = $CI->db->get()->result_array();
        foreach($result as $libellePdg =>$value) {
            foreach($value as $key) {
                $emplacement = $key;
            }
        }
        return $emplacement;
    }

    



    
}