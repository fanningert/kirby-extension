# KirbyText Extension - Image

*Version:* 0.3

This extended version of the original KirbyText image function replace the original.

## Options

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