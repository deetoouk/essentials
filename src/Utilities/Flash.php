<?php

namespace DeeToo\Essentials\Utilities;

class Flash
{
    protected $overlay = false;

    protected $timer = 1700;

    protected $is_html = false;

    public function withOverlay($with = true)
    {
        $this->overlay = $with;

        return $this;
    }

    public function isHtml(bool $is_html)
    {
        $this->is_html = $is_html;
    }

    public function setTimer(int $timer)
    {
        $this->timer = $timer;
    }

    public function getTimer() : int
    {
        return $this->timer;
    }

    public function info($message, $title = null, $timer = null, $is_html = null)
    {
        return $this->message('info', $message, $title ?: 'Message!', $timer, $is_html);
    }

    private function message($type, $message, $title, $timer = null, $is_html = null)
    {
        if (isset($timer)) {
            $this->setTimer($timer);
        }

        if (isset($is_html)) {
            $this->isHtml($is_html);
        }

        return session()->flash(
            'flash_message',
            compact('type', 'title', 'overlay') + [
                'text'              => $message,
                'html'              => $this->is_html,
                'timer'             => $this->overlay ? null : $this->timer,
                'showConfirmButton' => $this->overlay ? true : false,
            ]
        );
    }

    public function success($message, $title = null, $timer = null, $is_html = null)
    {
        return $this->message('success', $message, $title ?: 'Success!', $timer, $is_html);
    }

    public function error($message, $title = null, $timer = null, $is_html = null)
    {
        return $this->message('error', $message, $title ?: 'Error!', $timer, $is_html);
    }

    public function warning($message, $title = null, $timer = null, $is_html = null)
    {
        return $this->message('warning', $message, $title ?: 'Error!', $timer, $is_html);
    }
}
