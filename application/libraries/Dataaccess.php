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
        $sql = 'select libellePdg, version, style from stockerPageDeGarde';
        $query = $CI->db->query($sql);
        $result = $query->result_array();
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
        $sql = 'select distinct libellePdg from pageDeGarde;';
        $query = $CI->db->query($sql);
        $result = $query->result_array();
        //on recupere les elements de la requete dans un tableau sans les clés array['libellePdg']
        $tableauPdg = array();
        $i = 0;
        foreach($result as $libellePdg => $value) {
            foreach($value as $key) {
                $tableauPdg[$i] = $key;
                $i++;
            }
        }
        return $tableauPdg;
    }

    public static function GetVersionForPdg($libellePdg) {
        $CI =& get_instance();
        $sql ="select version from pageDeGarde where libellePdg = ?" ;
        $query = $CI->db->query($sql, $libellePdg);
        $result = $query->result_array();
        //on recupere les elements de la requete dans un tableau sans les clés array['libellePdg']
        $tableauPdg = array();
        $i = 0;
        foreach($result as $libellePdg => $value) {
            foreach($value as $key){
                $tableauPdg[$i] =$key;
                $i++; 
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
        $i = 0;
        foreach($result as $libellePdg => $value) {
            foreach($value as $key)
            $tableauPdg[] = $key;
            $i++;
        }
        return $tableauPdg;
    }

    



    
}