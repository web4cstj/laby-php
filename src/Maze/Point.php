<?php
namespace Maze;
class Point {
    public $x = 0;
    public $y = 0;
    function __construct($x = 0, $y = 0) {
        $this->x = $x;
        $this->y = $y;
    }
    static function init() {

    }
    static function main() {

    }
    function rand($w, $h) {
        $this->x = rand(0, $w - 1);
        $this->y = rand(0, $h - 1);
        return $this;
    }
}
Point::init();