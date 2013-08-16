<?php

class Forum_Tags extends TagManager {

    /**
     * Tags declaration
     * To be available, each tag must be declared in this static array.
     *
     * @var array
     *
     */
    public static $tag_definitions = array (
        "forum:main" => "tag_main",
        "forum:main:forums" => "tag_forums",
        "forum:topics" => "tag_topics"
    );
    
    public static function index(FTL_Binding $tag)
    {
        $str = $tag->expand();
        return $str;
    }    
    
    public function tag_main(FTL_Binding $tag) {
    
        $str = "";
        
        $segments = explode('/', self::$ci->uri->uri_string());
      
      if(!isset($segments[1])) {
        
           self::load_model('forum_model');
           
           $forums = self::$ci->forum_model->get_forums_list(array('parent' => 0))->result();
    
           if(is_array($forums)) {
    
              foreach($forums as $forum) {
              
                  $tag->set('id', $forum->id_forum);               
                  $tag->set('title', $forum->title);
                  $tag->set('description', $forum->description);
                  $tag->set('num_forums', $forum->num_forums);
                  $tag->set('num_topics', $forum->num_topics);
                  
                  $tag->set('forums', $tag->expand());
                     
                  $str .= $tag->expand();
              }
       
              return $str;
       
           }
       
       } else {
       
         return $str;
       
       }
    
    }
    
    public function tag_forums(FTL_Binding $tag) {
    
        $str = ""; self::load_model('forum_model');
        
        $parent = $tag->get('id');        
        
        $forums = self::$ci->forum_model->get_forums_list(array('parent' => $parent))->result();
 
        if(is_array($forums)) {
 
           foreach($forums as $forum) {
               
               $tag->set('title', $forum->title);               
               $tag->set('link', $forum->url);
               $tag->set('description', $forum->description);
               $tag->set('num_forums', $forum->num_forums);
               $tag->set('num_topics', $forum->num_topics);
                  
               $str .= $tag->expand();
           }
    
           return $str;
    
        }
    
    }  
    
    public function tag_topics(FTL_Binding $tag) {
      
      $str = "";
      
      $segments = explode('/', self::$ci->uri->uri_string());
      
      if(isset($segments[1])) {
      
         $url = $segments[1];
      
         self::load_model('forum_model');
           
           $forums = self::$ci->forum_model->get_forums_list(array('url' => $url))->result();
    
           if(is_array($forums)) {
    
              foreach($forums as $forum) {
              
                  $tag->set('id', $forum->id_forum);               
                  $tag->set('title', $forum->title);
                  $tag->set('description', $forum->description);
                  $tag->set('num_topics', $forum->num_forums);
                  
                  //$tag->set('topics', $tag->expand());
                     
                  $str .= $tag->expand();
              }
       
              return $str;
       
           } else {
            
              return "forum not found in database"; 
            
           }
      
      } else {
      
         return $str;
      
      } 
      
    }  
 
}
