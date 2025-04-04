<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function index()
    {


        //        $categories = \App\Models\Category::all();
        //        foreach ($categories as $category)
        //        {
        //            echo $category->id .'-'. $category->title .'--';
        //        }
        $categories = \App\Models\Category::paginate(5);
        foreach ($categories as $category) {
            echo $category->id . '-' . $category->title . '--';
        }
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