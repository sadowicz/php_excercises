<?php

namespace Controller;

use Widget\Link;
use Widget\Button;

class DemoController extends Controller
{
    public function index()
    {
        return ["demo.index", ["title" => "Demo"]];
    }

    private function demo(string $type): array
    {
        $storage = $this->storage($type);

        $widgets = [
            new Link(1), new Link(2), new Link(3), new Link(4),
            new Button(1), new Button(2), new Button(3), new Button(4)
        ];

        foreach ($widgets as $widget)
            $storage->store($widget);

        $storage->remove("widget_link_4");
        $storage->remove("widget_button_4");

        return [
            "title" => "Demo for " . $type,
            "widgets" => $storage->loadAll(),
        ];
    }

    public function mysql()
    {
        return ["demo.show", $this->demo("mysql")];
    }

    public function sqlite()
    {
        return ["demo.show", $this->demo("sqlite")];
    }

    public function file()
    {
        return ["demo.show", $this->demo("file")];
    }

    public function session()
    {
        return ["demo.show", $this->demo("session")];
    }

    public function redis()
    {
        return ["demo.show", $this->demo("redis")];
    }
}