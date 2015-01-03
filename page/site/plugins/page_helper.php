<?php

class PageHelper {
 
  /**
   * Insert the content of a page into to the current page, at the position of KirbyText tag.
   *
   * @param $page Current page
   * @param $insert_page Source page for the insert
   * @param $page_param Insert option
   * @return Content
   */
  public static function getContent($page, $insert_page, $page_param = array()){
    
    $defaults = array();

    if(!$inser_page) return;

    $param = array();
    foreach($defaults as $key => $value){
      $param[$key] = $value;
      if( array_key_exists($key, $image_param) and !empty($image_param[$key]))
        $param[$key] = (String)$image_param[$key];
    }

    $param['full_content'] = ($param['full_content'] == 'true')?true:false;

    if($param['full_content'] === true){
      return $page->content()->kirbytext();
    }else{
      if(!$page->excerpt()->empty()) {
        return $page->excerpt()->kirbytext();
      }else{
        return '<p>'.$page->text()->kirbytext()->excerpt(250).'</p>';
      }
    }
  }
}