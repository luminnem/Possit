<?php
//
// Usage:
// $colors = array("#fff", "#000", "#ccc");
// $color = RandomColor->getRandomColor();
//
class RandomColor {
    private $colorList;
    
    public function __construct($colorList) {
        $this->colorList = $colorList;
    }
    
    public function getRandomColor() {
        $v = rand(0, count($this->colorList)-1);
        return $this->colorList[$v];
    }
}

function Brightness($hex, $steps) {
    $steps = max(-255, min(255, $steps));

    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));

    $r = max(0,min(255,$r + $steps));
    $g = max(0,min(255,$g + $steps));  
    $b = max(0,min(255,$b + $steps));

    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

    return '#'.$r_hex.$g_hex.$b_hex;
}

?>