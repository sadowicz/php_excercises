<?php

class App
{
    public function run() {
        //Creates storage object
        $storage = new Storage\FileStorage();

        //Creates several widgets
        $widgets = array();
        for($i = 0; $i < 3; $i += 1) {
            array_push($widgets, new Widget\Link($i + 1), new Widget\Button($i + 1));
        }

        //Stores widgets into storage
        foreach($widgets as $widget) {
            $storage->store($widget);
        }

        //Loads widgets from storage
        $loaded_widgets = $storage->loadAll();

        //Draws widgets using render method
        foreach($loaded_widgets as $loaded_widget) {
            $this->render($loaded_widget);
        }
    }

    private function render(Widget\Widget $widget) {
        $widget->draw();
    }
}
