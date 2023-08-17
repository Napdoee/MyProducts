<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('nama', 'ASC')->get();

        return view('students.index', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => ['required'],
            'alamat' => ['required'],
            'jenis_kelamin' => ['required'],
            'tgl_lahir' => ['required'],
            'nama_orang_tua' => ['required'],
            'nomor_orang_tua' => ['required', 'numeric']
        ]);

        $IndukLatest = Student::orderBy('induk', 'desc')->first()->induk;
        $GetInduk = ++$IndukLatest;

        $student = new Student();

        $student->induk = $GetInduk;
        $student->nama = $request->nama;
        $student->alamat = $request->alamat;
        $student->jenis_kelamin = $request->jenis_kelamin;
        $student->tgl_lahir = $request->tgl_lahir;
        $student->nama_orang_tua = $request->nama_orang_tua;
        $student->nomor_orang_tua = $request->nomor_orang_tua;
        $student->save();

        return redirect()->route('student.index')->with([
            'message' => 'Berhasil menambahkan siswa',
            'status' => 'success',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {

        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $this->validate($request, [
            'nama' => ['required'],
            'alamat' => ['required'],
            'jenis_kelamin' => ['required'],
            'tgl_lahir' => ['required'],
            'nama_orang_tua' => ['required'],
            'nomor_orang_tua' => ['required', 'numeric']
        ]);

        $student->nama = $request->nama;
        $student->alamat = $request->alamat;
        $student->jenis_kelamin = $request->jenis_kelamin;
        $student->tgl_lahir = $request->tgl_lahir;
        $student->nama_orang_tua = $request->nama_orang_tua;
        $student->nomor_orang_tua = $request->nomor_orang_tua;
        $student->save();

        return redirect()->route('student.index')->with([
            'message' => 'Berhasil mengubah siswa',
            'status' => 'info',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('student.index')->with([
            'message' => 'Berhasil menghapus siswa',
            'status' => 'danger'
        ]);
    }
}
