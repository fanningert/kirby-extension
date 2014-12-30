<?php
/**
 * Original work by Kirby developer. Extended by Thomas Fanninger
 *
 * @version: 0.6
 */
unset(kirbytext::$tags['image']);
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
    'grayscale',
    'width_output',
    'height_output'
  ),
  'html' => function($tag) {
    $image_options = array();
    $image = $tag->attr('image');

    foreach(kirbytext::$tags['image']['attr'] as $name) {
      if( !empty($value = $tag->attr($name)) )
        $image_options[$name] = $value;
    }
    unset($image_options['target']);
    unset($image_options['popup']);
    if(!empty($tag->target()))
      $image_options['target'] = $tag->target();

    if(array_key_exists('alt', $image_options) and !$image_options['alt'] and empty($image_options['alt']) and array_key_exists('text', $image_options) and !$image_options['text'] and !empty($image_options['text'])){
      $image_options['alt'] = $image_options['text'];
      unset($image_options['text']);
    }

    return ImageHelper::getThumb($tag->page(), $image, $image_options);
  }
);
