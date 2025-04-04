<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{

    public function index()
    {


         $posts = Post::where('id','>',54)->get();
         dd($posts);
        //echo "index method in HomeController";
    }

    public function create()
    {
        echo "create method in HomeController";
    }

    public function store()
    {
        echo "store method in HomeController";
    }

    public function edit($id)
    {
        echo "edit method in HomeController";
    }

    public function update($id)
    {
        echo "update method in HomeController";
    }

    public function delete($id)
    {
        echo "delete method in HomeController";
    }

}