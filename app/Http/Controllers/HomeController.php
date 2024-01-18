<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class HomeController extends Controller
{
    public function index(){

        $marcas = Marca::orderBy('nm_marca', 'ASC');
        $users = User::orderBy('name', 'ASC');


        // dd('asdfasd');
        // dd($marcas->get());
        if(request()->has('_token')){
            $postsJoinUsersAndMarca = DB::table('posts')
                ->join('users', 'posts.id_user', '=', 'users.id')
                ->join('marcas', 'posts.id_marca', '=', 'marcas.id_marca');
                // ->select('users.name', 'users.id', 'posts.*')
                // ->get();
            $pesquisas = $postsJoinUsersAndMarca->when(request()->marca, function($query){
                $query->where('marcas.id_marca', request()->marca);
            })
                ->when(request()->user, function($query){
                    $query->where('users.id', request()->user);
                })
                ->when(request()->content, function($query){
                    $query->where('posts.ds_post', 'like' , '%' . request()->content . '%');
                })
                ->select('users.id', 'users.name', 'posts.id', 'posts.ds_post', 'marcas.id_marca', 'marcas.nm_marca')
                ->get();

                // dd($pesquisa);
            
        }

        $posts = Post::get();
        // dd($posts);

        // $teste = Post::first();
        // dd($teste->user->name);        
        
        return view('home', [
            'marcas' => $marcas->get(),
            'users' => $users->get(),
            'posts' => $posts
        ]);
    }
}
