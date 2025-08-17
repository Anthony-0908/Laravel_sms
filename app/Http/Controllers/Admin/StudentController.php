<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Yajra\DataTables\DataTables;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.student.index');
    }

    public function getStudents() 
    {
       return DataTables::of(User::query())
        ->addIndexColumn()
        ->addColumn('action', function($row){
            return '<a href="/users/'.$row->id.'/edit" class="btn btn-sm btn-primary">Edit</a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        try {
            $request->validate([
                'name'       => 'required|string|max:255',
                'email'      => 'required|email|unique:users,email',
                'password'   => 'required|min:6',
                'student_id' => 'required|string|unique:students,student_id',
            ]);

            DB::beginTransaction();

            // Create user
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
            ]);

            // Create student linked to this user
            $student = Student::create([
                'user_id'    => $user->id,
                'student_id' => $request->student_id,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Student registered successfully',
                'user'    => $user,
                'student' => $student,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error registering student',
                'error'   => $e->getMessage()
            ], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         // Get user and related student
        $user = User::with('student')->findOrFail($id);

        return view('admin.student.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $id)
    {
        // Get user and related student
        $user = User::with('student')->findOrFail($id);

        return view('admin.student.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, string $id)
{
    try {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,'.$id,
            'password'   => 'nullable|min:6', // only update if provided
            'student_id' => 'required|string|unique:students,student_id,'.$id.',user_id',
        ]);

        DB::beginTransaction();

        // Find user and related student
        $user = User::findOrFail($id);
        $student = Student::where('user_id', $id)->firstOrFail();

        // Update user
        $user->name  = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        // Update student
        $student->student_id = $request->student_id;
        $student->save();

        DB::commit();

        return response()->json([
            'message' => 'Student updated successfully',
            'user'    => $user,
            'student' => $student,
        ], 200);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'message' => 'Error updating student',
            'error'   => $e->getMessage(),
        ], 500);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findorFail($id);
        $user->delete();

        return redirect()->route('students.index');
    }
}
