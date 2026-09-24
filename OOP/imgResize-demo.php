<?php
// parent class
class ImageResizer {
    public function resize($image, $x, $y) {
        // resizing logic
    }
}

// Child class 1 - HQ img resizer
class HQResizer extends ImageResizer {
    public function resize($image) {
        // HQ resizing logic
    }
}

// Child class 2 - Thumb resizer
class ThumbResizer extends ImageResizer {
    public function resize($image) {
        // thumb resizing logic
    }
}

$image = "image"; // the file we want to resize
$x = 100;
$y = 200;

// basic class/object in action
$resizer = new ImageResizer();
$resizer->resize($image, $x, $y);

$HQResizer = new HQResizer();
$thumbResizer = new ThumbResizer();

// Polymorphism in action
$resizers = [$HQResizer, $thumbResizer];

foreach ($resizers as $resizer) {
    $resizedImage = $resizer->resize($image);
    // Depending on the type and setting of resizer
}
