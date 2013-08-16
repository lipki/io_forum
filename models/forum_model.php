<?php

class Forum_model extends CI_Model {
   
   public function __construct() {
      parent::__construct();
   }
   
   public function get_forums_list($where="") {
   
      $lang = Settings::get_lang();
      
      $this->db->select("
            fp.*,
            fpl.*,
         ")->from("forums AS fp");
         
      $this->db->join("forums_lang AS fpl", "fp.id_forum = fpl.id_forum AND fpl.lang = '$lang'");
      
      if(is_array($where)) {
         foreach($where as $name => $value) {
            $this->db->where($name, $value);
         }
      }
      
      return $this->db->get();   
   }
   
}
