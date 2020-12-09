<?php

namespace String;

class Editor
{
    private string $text;

    public function __construct(string $text) {

        $this->text = $text;
    }

    public function get() : string {

        return $this->text;
    }

    public function replace(string $search, string $replace) : object {

        $this->text = str_replace($search, $replace, $this->text);
        return $this;
    }

    public function lower() : object {

        $this->text = strtolower($this->text);
        return $this;
    }

    public function upper() : object {

        $this->text = strtoupper($this->text);
        return $this;
    }

    public function censor(string $censored) : object {

        $replace = str_repeat('*', strlen($censored));
        $this->text = str_replace($censored, $replace, $this->text);

        return $this;
    }

    public function remove(string $removed) : object {

        return $this->replace($removed, '');
    }

    public function repeat(string $repeated, int $repeats) : object {

        $repeat = str_repeat($repeated, $repeats);
        $this->text = str_replace($repeated, $repeat, $this->text);

        return $this;
    }
}
