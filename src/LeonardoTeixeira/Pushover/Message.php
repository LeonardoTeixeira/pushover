<?php

namespace LeonardoTeixeira\Pushover;

use LeonardoTeixeira\Pushover\Exceptions\InvalidArgumentException;

class Message
{
    private $message;
    private $title;
    private $url;
    private $urlTitle;
    private $priority;
    private $sound;
    private $html;
    private $date;

    public function __construct($message = null, $title = null, $priority = Priority::NORMAL)
    {
        $this->message = $message;
        $this->title = $title;
        $this->priority = $priority;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getUrlTitle()
    {
        return $this->urlTitle;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function getSound()
    {
        return $this->sound;
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setUrlTitle($urlTitle)
    {
        $this->urlTitle = $urlTitle;
    }

    public function setPriority($priority)
    {
        if (!Priority::has($priority)) {
          throw new InvalidArgumentException('The priority \'' . $priority . '\' is invalid.');
        }
        $this->priority = $priority;
    }

    public function setSound($sound)
    {
        if (!Sound::has($sound)) {
          throw new InvalidArgumentException('The sound \'' . $sound . '\' is invalid.');
        }
        $this->sound = $sound;
    }

    public function setHtml($html)
    {
        if ($html)
            $this->html = 1;
        else
            $this->html = 0;
    }

    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    public function hasTitle()
    {
        return !is_null($this->title);
    }

    public function hasUrl()
    {
        return !is_null($this->url);
    }

    public function hasUrlTitle()
    {
        return !is_null($this->urlTitle);
    }

    public function hasSound()
    {
        return !is_null($this->sound);
    }

    public function hasHtml()
    {
        return !is_null($this->html);
    }

    public function hasDate()
    {
        return ($this->date instanceof \DateTime);
    }
}
