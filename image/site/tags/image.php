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
 * @version: 0.4
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
    $image_options = array();
    $image = $tag->attr('image');

    foreach(kirbytext::$tags['image']['attr'] as $name) {
      if( !empty($value = $tag->attr($name)) )
        $image_options[$name] = $value;
    }
    unset($image_options['target']);
    unset($image_options['popup']);
    $image_options['target'] = $tag->target();

    return ImageHelper::getThumb($tag->page(), $image, $image_options);
  }
);
