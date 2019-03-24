<?php

namespace LeonardoTeixeira\Pushover;

use LeonardoTeixeira\Pushover\Exceptions\InvalidArgumentException;

class Glances
{
    private $title;   //(100 characters) - a description of the data being shown, such as "Widgets Sold"
    private $text;    //(100 characters) - the main line of data, used on most screens
    private $subtext; //(100 characters) - a second line of data
    private $count;   //(integer, may be negative) - shown on smaller screens; useful for simple counts
    private $percent; //(integer 0 through 100, inclusive) - shown on some screens as a progress bar/circle

    public function __construct()
    {
        $this->title = null;
        $this->text = null;
        $this->subtext = null;
        $this->count = null;
        $this->percent = null;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getSubtext()
    {
        return $this->subtext;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function getPercent()
    {
        return $this->percent;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setSubtext($subtext)
    {
        $this->subtext = $subtext;
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

    public function setPercent($percent)
    {
        if ($percent < 0 || $percent > 100) {
          throw new InvalidArgumentException('The percent value \'' . $percent . '\' is out of range.');
        }
        $this->percent = $percent;
    }

    public function hasTitle()
    {
        return !is_null($this->title);
    }

    public function hasText()
    {
        return !is_null($this->text);
    }

    public function hasSubtext()
    {
        return !is_null($this->subtext);
    }

    public function hasCount()
    {
        return !is_null($this->count);
    }

    public function hasPercent()
    {
        return !is_null($this->percent);
    }
}
