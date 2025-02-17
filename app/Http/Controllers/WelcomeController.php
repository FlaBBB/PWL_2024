<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    function hello() {
        return "Hello World!";
    }

    function greeting() {
        return view("blog/hello")
            ->with("name", "Fikri Muhammad Abdillah")
            ->with("occupation", "Astronaut");
    }
}
