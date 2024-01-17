<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $marcas = Marca::orderBy('nm_marca', 'ASC');

        // dd($marcas->get());

        $posts = Post::get();
        // dd($posts);

        // $teste = Post::first();
        // dd($teste->user->name);        
        
        return view('home', [
            'marcas' => $marcas->get(),
            'posts' => $posts
        ]);
    }
}
