<?php

namespace Controller;

class HomeController extends Controller
{
    public function index()
    {
        return ["home.index", ['title' => 'Homepage']];
    }
}