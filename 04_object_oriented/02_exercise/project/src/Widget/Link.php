<?php
namespace Widget;

class Link extends Widget {
    public function draw() {
        echo '<a href="">'.$this->key().'</a></br>';
    }
}
