# KirbyText Extension - Image

*Version:* 0.4

This extended version of the original KirbyTag image function replace the original.

## ToDos

* Make the overwrite of the original KirbyTag as an Option
* Upscale function

## Changes

### 0.4

* Move the logic into to a plugin (static method). So you can use the function every where in Kirby (template, other KirbyTag, ...)
* Add many possible Kirby config options (I know this is not perfect, because I am using the kirby namespace. But when anyone have a idea for a better namespace. Please tell your idea. As ABAP developer I would change it to zkirbytext....)
* Optimize the logic

### 0.3

* Initial version

## Options for KirbyTag

* *width*: (optional) 
* *height*: (optional) 
* *alt*: (optional) 
* *text*: (optional) 
* *title*: (optional, Default: image title) 
* *class*: (optional) 
* *imgclass*: (optional) 
* *linkclass*: (optional) 
* *caption*: (optional)
* *caption_top*: (optional, Values: true/false, Default: false) Place the caption at the top of the image
* *link*: (optional) 
* *target*: (optional) 
* *popup*: (optional) 
* *rel*: (optional) 
* *resize*: (optional, Values: none, resize, crop, Default: none) Resize-Methode
* *quality*: (optional, Default: 100) 
* *blur*: (optional, Values: true/false, Default: false) Blurs the image using the Gaussian method.
* *upscale*: (optional, Values: true/false, Default: false) Upscale the image
* *grayscale*: (optional, Values: true/false, Default: false) Converts the image into grayscale.

## Config Options

| Kirby option                | Default |
| --------------------------- | ------- |
| kirbytext.image.width       | empty   |
| kirbytext.image.height      | empty   |
| kirbytext.image.figureclass | 'image' |
| kirbytext.image.imgclass    | empty   |
| kirbytext.image.linkclass   | empty   |
| kirbytext.image.caption_top | false   |
| kirbytext.image.target      | empty   |
| kirbytext.image.resize      | false   |
| kirbytext.image.quality     | 100     |
| kirbytext.image.blur        | false   |
| kirbytext.image.upscale     | false   |
| kirbytext.image.grayscale   | false   |

## Examples

### Simple

```
(image: dsc00439.jpg width: 200)
```

### Resize

```
(image: dsc00439.jpg resize: resize width: 200 height: 200)
```

```
(image: dsc00439.jpg resize: resize width: 200)
```

### Crop

```
(image: dsc00439.jpg resize: crop width: 200 height: 200)
```

### Blur

```
(image: dsc00439.jpg resize: resize width: 200 blur: true)
```

### Grayscale

```
(image: dsc00439.jpg resize: resize width: 200 grayscale: true)
```

### Upscale (not working at the moment)

```
(image: dsc00439_small.jpg resize: resize width: 200 upscale: true)
```

### Caption

#### Caption at the bottom

```
(image: dsc00439.jpg resize: resize width: 200 caption: Test)
```

#### Caption at the top

```
(image: dsc00439.jpg resize: resize width: 200 caption: Test caption_top: true)
```