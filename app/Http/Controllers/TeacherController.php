<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::latest()->get();

        return view('teachers.index', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => ['required', 'string'],
            'tgl_lahir' => ['required'],
            'alamat' => ['required'],
            'no_telp' => ['required', 'numeric']
        ]);

        $teacher = new Teacher;
        $teacher->nama = $request->nama;
        $teacher->tgl_lahir = $request->tgl_lahir;
        $teacher->alamat = $request->alamat;
        $teacher->no_telp = $request->no_telp;
        $teacher->save();

        return redirect()->route('teacher.index')->with([
            'message' => 'Teacher created',
            'status' => 'success'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $this->validate($request, [
            'nama' => ['required', 'string'],
            'tgl_lahir' => ['required'],
            'alamat' => ['required'],
            'no_telp' => ['required', 'numeric']
        ]);

        $teacher->nama = $request->nama;
        $teacher->tgl_lahir = $request->tgl_lahir;
        $teacher->alamat = $request->alamat;
        $teacher->no_telp = $request->no_telp;
        $teacher->save();

        return redirect()->route('teacher.index')->with([
            'message' => 'Teacher updated',
            'status' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('teacher.index')->with([
            'message' => 'Teacher deleted',
            'status' => 'danger'
        ]);
    }
}
