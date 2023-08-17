<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $studentCount = [
            'Laki-laki' => Student::where('jenis_kelamin', 'Laki-laki')->count(),
            'Perempuan' => Student::where('jenis_kelamin', 'Perempuan')->count(),
        ];
        $teacherCount = Teacher::count();

        return view('home', compact('studentCount', 'teacherCount'));
    }
}
