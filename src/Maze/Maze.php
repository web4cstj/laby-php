<?php

namespace Maze;

class Maze
{
    const WRAPPING_HORIZONTAL = 1;
    const WRAPPING_VERTICAL = 2;
    public $generated = false;
    public $grid = null;
    public $wrapping = 0;
    public $w = 0;
    public $h = 0;
    function __construct($w, $h, $wrapping = 0)
    {
        $this->w = $w;
        $this->h = $h;
        $this->wrapping = $wrapping;
        $this->grid = $this->emptyGrid();
    }
    function reset()
    {
        array_walk_recursive($this->grid, function ($cell) {
            $cell->reset();
        });
    }
    function emptyGrid()
    {
        $result = [];
        for ($i = 0; $i < $this->h; $i += 1) {
            $row = [];
            for ($j = 0; $j < $this->w; $j += 1) {
                $row[] = new Cell($j, $i);
            }
            $result[] = $row;
        }
        return $result;
    }
    function generate()
    {
        $this->reset();
        $this->move(Cursor::createRand($this->w, $this->h));
        return $this;
    }
    function move($cursor)
    {
        while ($cursor) {
            $cursor = $cursor->move(function ($step) {
                return $this->isValidCell($step);
            });
            $this->openTo($cursor);
        }
    }
    function openTo($cursor)
    {
        if (!$cursor) return;
        $this->getCell($cursor)->openBack($cursor->previousStep->getDirection());
        $this->getCell($cursor->previousStep)->open($cursor->previousStep->getDirection());
        return $this;
    }
    function isValidCell($cursor)
    {
        if ($this->wrapping & self::WRAPPING_HORIZONTAL) {
            $cursor->x = ($cursor->x + $this->w) % $this->w;
        }
        if ($this->wrapping & self::WRAPPING_VERTICAL) {
            $cursor->y = ($cursor->y + $this->h) % $this->h;
        }
        $cell = $this->getCell($cursor);
        return ($cell && $cell->getId() === 0);
    }
    function getCell($cursor)
    {
        if (!$this->isInside($cursor)) return false;
        return $this->grid[$cursor->y][$cursor->x];
    }
    function setCell($cursor, $value)
    {
        if (!$this->isInside($cursor)) return false;
        $this->grid[$cursor->y][$cursor->x] = $value;
        return $this;
    }
    function isInside($cursor)
    {
        return !($cursor->x < 0 || $cursor->x >= $this->w || $cursor->y < 0 || $cursor->y >= $this->h);
    }
    function toArray()
    {
        $result = [];
        foreach ($this->grid as $r) {
            $row = [];
            foreach ($r as $cell) {
                $row[] = $cell->getId();
            }
            $result[] = $row;
        }
        return $result;
    }
}
