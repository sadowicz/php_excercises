<?php

namespace Container;

class RingBuffer {

    private int $capacity;
    private int $size;
    private array $data;
    private int $readIndex;
    private int $writeIndex;

    public function __construct(int $capacity = 1) {

        $this->capacity = $capacity;
        $this->size = 0;
        $this->readIndex = 0;
        $this->data = array_fill(0, $this->capacity, null);
        $this->writeIndex = 0;
    }

    public function empty() : bool {

        return $this->size == 0;
    }

    public function full() : bool {

        return $this->size == $this->capacity;
    }

    public function capacity() : int {

        return $this->capacity;
    }

    public function size() : int {

        return $this->size;
    }

    public function head() {

        $index = $this->writeIndex + ($this->writeIndex == 0) * $this->capacity - 1;

        return $this->data[$index];
    }

    public function tail() {

        return $this->data[$this->readIndex];
    }

    public function at(int $index) {

        return $this->data[$index];
    }

    public function push(string $element) {

        $this->data[$this->writeIndex] = $element;
        $this->writeIndex = ($this->writeIndex + 1) % $this->capacity();
        $this->readIndex = ($this->readIndex + ($this->size() == $this->capacity())) % $this->capacity();

        $this->size += ($this->size() < $this->capacity());
    }

    public function pop() {

        $element = $this->data[$this->readIndex];
        $this->data[$this->readIndex] = null;
        $this->readIndex = ($this->readIndex + 1) % $this->capacity();

        $this->size -= ($this->size > 0);

        return $element;
    }

}