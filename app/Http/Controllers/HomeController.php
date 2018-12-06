<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     //seccion 5 - 15: middleware proteger la zona de autentificacion de nuestra aplicacion 
    //     $this->middleware('auth')->except(['index']) ;
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //acceder a todos los cursos paginados
        //withCount nos permite recoger el conteo de una relacion
        $courses = Course::withCount(['students'])
        //devuelve una relacion entera
            ->with('category', 'teacher', 'reviews')
            ->where('status', Course::PUBLISHED)
            ->latest()
            ->paginate(12);
            //dd($courses);
        return view('home', compact('courses'));
    }
}
