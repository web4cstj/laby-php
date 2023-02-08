<?php
namespace Maze;
class Cursor extends Point {
    public $steps = [[ 'x'=> 0, 'y'=> -1 ], [ 'x'=> 1, 'y'=> 0 ], [ 'x'=> 0, 'y'=> 1 ], [ 'x'=> -1, 'y'=> 0 ],];
    public $previousStep = null;
    private $_direction = 0;
    private $directions = [];
    private $spin = 0;
    function __construct($x = 0, $y = 0, $direction = 0, $spin = 0) {
        parent::__construct($x, $y);
        $this->_direction = $direction;
        $this->spin = $spin;
    }
    function getDirection() {
        return $this->_direction;
    }
    function setDirection($val) {
        $this->_direction = ($val % 4 + 4) % 4;
        $directions = [0, 1, 2, 3];
        if ($this->spin === 0) {
            $directions = array_reverse($directions);
            $end = array_splice($directions, 0, 4 - $val - 1);
            $directions = array_merge($directions, $end);
        } else {
            $end = array_splice($directions, 0, $val);
            $directions = array_merge($directions, $end);
        }
        $this->directions = $directions;
    }
    static function createRand($w, $h) {
        $result = new self();
        $result->rand($w, $h);
        $result->randDirection();
        return $result;
    }
    function randDirection() {
        $this->spin = rand(0, 1);
        $this->setDirection(rand(0, 3));
        return $this;
    }
    function clone() {
        $result = new self($this->x, $this->y, $this->getDirection(), $this->spin);
        return $result;
    }
    function __toString() {
        return "Cursor : ({$this->x},{$this->y},{$this->getDirection()},{$this->spin});";
    }
    function move(Callable $validate) {
        $result = $this->clone();
        $result->previousStep = $this;
        $result->forward();
        $isValid = $validate($result);
        if ($isValid) {
            $result->randDirection($result->previousStep->getDirection());
            return $result;
        }
        $turn = $this->turn();
        if ($turn) {
            return $this->move($validate);
        }
        if ($this->previousStep === null) {
            return false;
        }
        return $this->previousStep->move($validate);
    }
    function turn() {
        if (count($this->directions) === 0) return false;
        $this->_direction = array_shift($this->directions);
        return $this;
    }
    function forward($n = 1) {
        $step = $this->steps[$this->_direction];
        $this->x += $n * $step['x'];
        $this->y += $n * $step['y'];
        return $this;
    }
    function backward($n = 1) {
        $step = $this->steps[$this->_direction];
        $this->x -= $n * $step['x'];
        $this->y -= $n * $step['y'];
        return $this;
    }
    function left($n = 0) {
        $this->_direction = ($this->_direction + 3) % 4;
        return $this->forward($n);
    }
    function right($n = 0) {
        $this->_direction = ($this->_direction + 1) % 4;
        return $this->forward($n);
    }
}