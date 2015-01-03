<?php

kirbytext::$tags['page'] = array(
  'attr' => array(),
  'html' => function($tag) {

    if(empty($tag->attr('page')))
      return;
    $insert_page = $tag->page()->site()->find( $tag->attr('page') );

    $page_param = array();
    foreach(kirbytext::$tags['page']['attr'] as $name) {
      if( !empty($value = $tag->attr($name)) )
        $page_param[$name] = $value;
    }

    return PageHelper::getContent($tag->page(), $insert_page, $page_param);
  }
);