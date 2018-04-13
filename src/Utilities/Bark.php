<?php

namespace DeeToo\Essentials\Utilities;

class Bark
{
    protected $overlay = false;

    public function withOverlay($with = true)
    {
        $this->overlay = $with;

        return $this;
    }

    public function info($message, $title = null)
    {
        return $this->message('info', $message, $title ?: 'Message!');
    }

    private function message($type, $message, $title)
    {
        $overlay = $this->overlay;

        return ['bark' => compact('type', 'message', 'title', 'overlay')];
    }

    public function success($message, $title = null)
    {
        return $this->message('success', $message, $title ?: 'Success!');
    }

    public function error($message, $title = null)
    {
        return $this->message('error', $message, $title ?: 'Error!');
    }

    public function warning($message, $title = null)
    {
        return $this->message('warning', $message, $title ?: 'Error!');
    }
}
