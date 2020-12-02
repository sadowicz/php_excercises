<?php

namespace Controller;

class AboutController extends Controller
{
    public function index()
    {
        return ["about.index", ["title" => "About"]];
    }
}
