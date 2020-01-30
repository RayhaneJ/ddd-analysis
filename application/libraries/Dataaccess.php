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
        $CI->db->select('libellePdg');
        $CI->db->select('version');
        $CI->db->select('style');
        $CI->db->from('stockerPageDeGarde');
        $result =$CI->db->get()->result_array();
        //on recupere les elements de la requete dans un tableau sans les clés array['libellePdg']
        $tableauPdg = array();
        $i = 0;
        foreach($result as $libellePdg => $value) {
                $tableauPdg[$i]['libellePdg'] = $value['libellePdg'];
                $tableauPdg[$i]['version'] = $value['version'];
                $tableauPdg[$i]['couleur'] = $value['style'];
                $i++;
        }
        return $tableauPdg;
    }

    public static function getAllPdg() {
        $CI =& get_instance();
        $CI->db->select('libellePdg');
        $CI->db->distinct();
        $CI->db->from('pageDeGarde');
        $result = $CI->db->get()->result_array();
        //on recupere les elements de la requete dans un tableau sans les clés array['libellePdg']
        $tableauPdg = array();
        foreach($result as $libellePdg => $value) {
            foreach($value as $key) {
                $tableauPdg[] = $key;
            }
        }
        return $tableauPdg;
    }

    public static function GetVersionForPdg($libellePdg) {
        $CI =& get_instance();
        $CI->db->select('version');
        $CI->db->from('pageDeGarde');
        $CI->db->where('libellePdg', $libellePdg);
        $result = $CI->db->get()->result_array();
        //on recupere les elements de la requete dans un tableau sans les clés array['libellePdg']
        $tableauPdg = array();
        foreach($result as $libellePdg => $value) {
            foreach($value as $key){
                $tableauPdg[] =$key;
            }
        }       
        return $tableauPdg;
    }

    public static function GetModeleForPdg($libellePdg, $numVersion) {
        $CI =& get_instance();
        $CI->db->select('style');
        $CI->db->from('stockerPageDeGarde');
        $CI->db->where('libellePdg', $libellePdg);
        $CI->db->where('version', $numVersion);
        $result = $CI->db->get()->result_array();
        //on recupere les elements de la requete dans un tableau sans les clés array['libellePdg']
        $tableauPdg = array();
        foreach($result as $libellePdg => $value) {
            foreach($value as $key)
            $tableauPdg[] = $key;
        }
        return $tableauPdg;
    }

    public static function GetPageDeGardeToView($style, $libellePdg, $version){
        $CI = & get_instance();
        $CI->db->select('emplacement');
        $CI->db->from('stockerPageDeGarde');
        $CI->db->where('style', $style);
        $CI->db->where('libellePdg', $libellePdg);
        $CI->db->where('version', $version);
        $result = $CI->db->get()->result_array();
        foreach($result as $libellePdg =>$value) {
            foreach($value as $key) {
                $emplacement = $key;
            }
        }
        return $emplacement;
    }

    



    
}