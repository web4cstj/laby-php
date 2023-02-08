<?php

namespace Maze;

use Maze\Point;

class Cell extends Point
{
    public $openings = [0, 0, 0, 0];
    function getId()
    {
        return bindec(implode("", array_reverse($this->openings)));
    }
    function setId($value)
    {
        $value = str_pad(decbin($value), 4, "0", STR_PAD_LEFT);
        $value = array_reverse(str_split($value));
        // $value = value.toString(2).padStart(4, "0");
        $value = array_map(function ($digit) {
            return intval($digit);
        }, $value);
        $this->openings = $value;
    }
    function reset()
    {
        $this->openings = [0, 0, 0, 0,];
    }
    function __toString()
    {
        return "Cell: ({$this->x},{$this->y},{$this->getId()});";
    }
    function html()
    {
        $result = '';
        $result .= '<div class="cell">';
        $result .= '<img src="img/maze2.svg#7" />';
        $result .= '</div>';
        return $result;
    }

    function open($direction)
    {
        $this->openings[$direction] = 1;
        return $this;
    }
    function openBack($direction)
    {
        $this->openings[($direction + 2) % 4] = 1;
        return $this;
    }
    function close($direction)
    {
        $this->openings[$direction] = 0;
        return $this;
    }
    function toggle($direction, $force = false)
    {
        $this->openings[$direction] = ($force === false) ? 1 - $this->openings[$direction] : $force;
        return $this;
    }
}
