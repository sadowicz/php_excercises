<?php
namespace Widget;

class Button extends Widget {
    public function draw() {
        echo '<input type="button" value="'.$this->key().'"></br>';
    }
}