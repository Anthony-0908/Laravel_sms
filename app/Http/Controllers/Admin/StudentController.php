<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Services\StudentService;
class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.student.index');
    }

   public function getStudents() 
    {
        $students = $this->studentService->getAllStudents();
        return DataTables::of($students)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                // Generate URLs for edit and delete
                $editUrl = route('students.edit', $row->id);
                $deleteUrl = route('students.destroy', $row->id);
                $showUrl = route('students.show' , $row->id);

                // Return HTML with both buttons
                return '
                    <a href="'.$editUrl.'" 
                        class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Edit
                    </a>

                    <a href="'.$showUrl.'"
                        class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Show
                    </a>

                    <form action="'.$deleteUrl.'" method="POST" 
                        style="display:inline-block;"
                        onsubmit="return confirm(\'Are you sure you want to delete this student?\')">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button type="submit" 
                            class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $studentStatus = $this->studentService->getStudentStatus();
        return view('admin.student.create', compact('studentStatus') );
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
                'address'    => 'nullable|string|max:255',
                'phone_no'   => 'nullable|string|max:15',
                'birthdate'  => 'required|date',
                'student_id' => 'required|string|unique:students,student_id',
            ]);

            DB::beginTransaction();

            // Create user
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'address' => $request->address,
                'phone_no' => $request->phone_no,
                'birthdate' => $request->birthdate,
                'password' => bcrypt($request->password),
            ]);

            // Create student linked to this user
            $student = Student::create([
                'user_id'    => $user->id,
                'student_id' => $request->student_id,
                'grade' => $request->grade,
                'section' => $request->section,
                'enrollment_date' => $request->enrollment_date,
                'status_id' => $request->status_id,
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
