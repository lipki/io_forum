<?php

class Forum_Tags extends TagManager
{
    /**
     * Tags declaration
     * To be available, each tag must be declared in this static array.
     *
     * @var array
     *
     */
    public static $tag_definitions = array (
        "forum" => "tag_render",
    ); 
 
    /**
     * Base module tag
     * The index function of this class refers to the <ion:#module_name /> tag
     * In other words, this function makes the <ion:#module_name /> tag
     * available as main module parent tag for all other tags defined
     * in this class.
     *
     * @usage  <ion:demo >
     *      ...
     *    </ion:demo>
     *
     */
    public static function index(FTL_Binding $tag)
    {
        $str = $tag->expand();
        return $str;
    }
 
 
    /**
     * Loops through authors
     *
     * @param FTL_Binding $tag
     * @return string
     *
     * @usage  <ion:demo:authors >
     *        ...
     *    </ion:demo:authors>
     *
     */
    public static function tag_render(FTL_Binding $tag) {
        
        $view = "valami";
 
        return $view;
    }
 
}
