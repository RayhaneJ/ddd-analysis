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

    public static function getAllPdg() {
        $CI =& get_instance();
        $sql = 'select libellePdg from pageDeGarde';
        $query = $CI->db->query($sql);
        $result = $query->result_array();
        //on recupere les elements de la requete dans un tableau sans les clés array['libellePdg']
        $tableauPdg = array();
        foreach($result as $libellePdg => $value) {
            foreach($value as $key => $row) {
                $tableauPdg[] = $row;
            }
        }
        
        return $tableauPdg;
    }

    // public static function codeBapsInsert($codeBaps, $libCours) {
    //     $sql = 'call codeBapsInsert(?, ?)';
    // }


    
}