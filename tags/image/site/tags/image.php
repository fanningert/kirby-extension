<?php

/**
 * Move this file to /site/tags/ and rename it image.php
 */

/**
 * @param array['width'] Width in pixel of the image. When crop/resize active, this is the new image width. Default: null
 * @param array['height'] Height in pixel of the image. When crop/resize active, this is the new image height. Default: null
 * @param array['alt']
 * @param array['text']
 * @param array['title'] 
 * @param array['class'] HTML class parameter for the figure container (only used when caption is provided)
 * @param array['imgclass'] HTML class parameter for the image container
 * @param array['linkclass'] HTML class parameter for the link container (only used when a link is provided)
 * @param array['caption'] Caption for the image (create a surrounded figure container for the image container)
 * @param array['caption_top'] Values: true/false, Default: false Position of the figcaption block at the top or bottom of the figure block
 * @param array['link'] Create a link container for the image
 * @param array['target']
 * @param array['popup'] not used
 * @param array['rel']
 * @param array['resize'] null/resize/crop Resize or crop the image via the thumb method Default: null
 * @param array['quality'] define the quality for the thumb Default: 100
 * @param array['blur'] true/false Default: false
 * @param array['upscale'] true/false Upscale the image if the original image is smaller Default: false
 * @param array['grayscale'] true/false Make a grayscaled image via thumb Default: false
 *
 * View: https://github.com/getkirby/toolkit/blob/bd759fa110bcec78b9e9c436438debdb6f7d63ab/lib/thumb.php for thumb
 *
 * @version: 0.3
 */
kirbytext::$tags['image'] = array(
  'attr' => array(
    'width',
    'height',
    'alt',
    'text',
    'title',
    'class',
    'imgclass',
    'linkclass',
    'caption',
    'caption_top',
    'link',
    'target',
    'popup',
    'rel',
    'resize',
    'quality',
    'blur',
    'upscale',
    'grayscale'
  ),
  'html' => function($tag) {

    $url       = $tag->attr('image');
    $alt       = $tag->attr('alt');
    $title     = $tag->attr('title');
    $link      = $tag->attr('link');
    $caption   = $tag->attr('caption');
    $caption_top = $tag->attr('caption_top', false);
    $resize    = $tag->attr('resize');
    $file      = $tag->file($url);
    // use the file url if available and otherwise the given url
    $url = $file ? $file->url() : url($url);
    $url_thumb = $url;
    //If resize == resize/crop use thumb
    if(!empty($resize) or !empty($tag->attr('blur')) or !empty($tag->attr('upscale')) or !empty($tag->attr('grayscale'))){
      $thumb_options = array();
      if( !empty($tag->attr('width')) or !empty($tag->attr('height')) )
        $thumb_options['crop'] = ($resize == 'crop')?true:false;
      if(!empty($tag->attr('width')))
        $thumb_options['width'] = $tag->attr('width');
      if(!empty($tag->attr('height')))
        $thumb_options['height'] = $tag->attr('height');
      $thumb_options['quality'] = $tag->attr('quality',100);
      $thumb_options['blur'] = $tag->attr('blur',false);
      $thumb_options['upscale'] = $tag->attr('upscale',false);
      $thumb_options['grayscale'] = $tag->attr('grayscale',false);
      $url_thumb = thumb($file,$thumb_options,false);
    }

    // alt is just an alternative for text
    if($text = $tag->attr('text')) $alt = $text;
    // try to get the title from the image object and use it as alt text
    if($file) {
      if(empty($alt) and $file->alt() != '') {
        $alt = $file->alt();
      }
      if(empty($title) and $file->title() != '') {
        $title = $file->title();
      }
    }
    if(empty($alt)) $alt = pathinfo($url, PATHINFO_FILENAME);
    $image = html::img($url_thumb, array(
      'width'  => $tag->attr('width'),
      'height' => $tag->attr('height'),
      'class'  => $tag->attr('imgclass'),
      'title'  => html($title),
      'alt'    => html($alt)
    ));
    if($tag->attr('link')) {
      // build the href for the link
      if($link == 'self') {
        $href = $url;
      } else if($file and $link == $file->filename()) {
        $href = $file->url();
      } else {
        $href = $link;
      }
      $image = html::a(url($href), $image, array(
        'rel'    => $tag->attr('rel'),
        'class'  => $tag->attr('linkclass'),
        'title'  => html($tag->attr('title')),
        'target' => $tag->target()
      ));
    }
    if(!empty($caption)) {
      $figure = new Brick('figure');
      $figure->addClass($tag->attr('class'));
      if($caption_top)
        $figure->append('<figcaption>' . html($caption) . '</figcaption>');
      $figure->append($image);
      if(!$caption_top)
        $figure->append('<figcaption>' . html($caption) . '</figcaption>');
      return $figure;
    }else{
      return $image; 
    }
  }
);