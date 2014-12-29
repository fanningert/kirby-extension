<?php

class ImageHelper {
  /**
   * Create/Get a Thumb of an image and return the HTML-Tag
   */
  public static function getThumb($page, $image_url, $param = array()){
    $defaults = array(
      'url'         => '',
      'url_thumb'   => '',
      'width'       => kirby()->option('kirbytext.image.width', ''),
      'height'      => kirby()->option('kirbytext.image.height', ''),
      'alt'         => '',
      'text'        => '',
      'title'       => '',
      'class'       => kirby()->option('kirbytext.image.figureclass', 'image'),
      'imgclass'    => kirby()->option('kirbytext.image.imgclass', ''),
      'linkclass'   => kirby()->option('kirbytext.image.linkclass', ''),
      'caption'     => '',
      'caption_top' => kirby()->option('kirbytext.image.caption_top', false),
      'link'        => '',
      'target'      => kirby()->option('kirbytext.image.target', ''),
      'popup'       => '',
      'rel'         => '',
      'resize'      => kirby()->option('kirbytext.image.resize', false),
      'quality'     => kirby()->option('kirbytext.image.quality', 100),
      'blur'        => kirby()->option('kirbytext.image.blur', false),
      'upscale'     => kirby()->option('kirbytext.image.upscale', false),
      'grayscale'   => kirby()->option('kirbytext.image.grayscale', false)
    );

    $param = array_merge($defaults, $param);
    
    //Check if $image is an internal image or a url
    $file = $page->file($image_url);
    $param['url'] = $file ? $file->url() : url($url);
    $param['url_thumb'] = $param['url'];
    
    //If resize == resize/crop use thumb
    if($param['resize'] or $param['resize'] == 'resize' or $param['resize'] == 'crop' or $param['blur'] or $param['upscale'] or $param['grayscale']){
      $thumb_options = array();
      if( !empty($param['width']) or !empty($param['height']) )
        $thumb_options['crop'] = ($param['resize'] == 'crop')?true:false;
      if( !empty($param['width']) )
        $thumb_options['width'] = $param['width'];
      if( !empty($param['height']) )
        $thumb_options['height'] = $param['height'];
      $thumb_options['quality'] = $param['quality'];
      $thumb_options['blur'] = $param['blur'];
      $thumb_options['upscale'] = $param['upscale'];
      $thumb_options['grayscale'] = $param['grayscale'];
      $thumb = thumb($file,$thumb_options,true);
      
      $thumb_dimension = $thumb->result->dimensions();
      $param['width'] = $thumb_dimension->width();
      $param['height'] = $thumb_dimension->height();
    }else{
      if($file){
        $file_dimension = $file->dimensions();
        if(empty($param['width']))
          $param['width'] = $file_dimension->width();
        if(empty($param['height']))
          $param['height'] = $file_dimension->height();
      }
    }
    
    //Texts
    if($param['text']) $param['alt'] = $param['text'] ;
    // try to get the title from the image object and use it as alt text
    if($file) {
      if(empty($param['alt']) and $file->alt() != '') {
        $param['alt'] = $file->alt();
      }
      if(empty($param['title']) and $file->title() != '') {
        $param['title'] = $file->title();
      }
    }
    if(empty($param['alt'])) $param['alt'] = pathinfo($param['url'] , PATHINFO_FILENAME);

    // build image tag
    $image = html::img($param['url_thumb'], array(
      'width'  => $param['width'],
      'height' => $param['height'],
      'class'  => $param['imgclass'],
      'title'  => html($param['title']),
      'alt'    => html($param['alt'])
    ));
    
    if($param['link']) {
      // build the href for the link
      if($param['link'] == 'self') {
        $href = $param['url'] ;
      } else if($file and $param['link'] == $file->filename()) {
        $href = $file->url();
      } else {
        $href = $param['link'];
      }
      $image = html::a(url($href), $image, array(
        'rel'    => $param['rel'],
        'class'  => $param['linkclass'],
        'title'  => html($param['title']),
        'target' => $param['target']
      ));
    }
    if(!empty($caption)) {
      $figure = new Brick('figure');
      $figure->addClass($param['class']);
      if($param['caption_top'])
        $figure->append('<figcaption>' . html($param['caption']) . '</figcaption>');
      $figure->append($image);
      if(!$param['caption_top'])
        $figure->append('<figcaption>' . html($param['caption']) . '</figcaption>');
      return $figure;
    }else{
      return $image; 
    }
  }
}