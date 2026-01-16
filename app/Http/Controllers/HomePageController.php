<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomePageController extends Controller
{
    public function index()
    {
        return Inertia::render('Home/Home');
    }

    public function profil()
    {
        return Inertia::render('Home/Profil');
    }

    public function documentAdministrasi()
    {
        return Inertia::render('Home/DocumentAdministrasi');
    }
    public function kontak()
    {
        return Inertia::render('Home/Kontak');
    }
}
