<?php

namespace Modules\HRIS\Http\Controllers\Database;

use Illuminate\Http\Request;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Database\EmployeePersonal;

class PhotoSignController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:hris.emp-photo-signature.view')->only('index','info');
        $this->middleware('permission:hris.emp-photo-signature.add')->only('store');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emppersonals = EmployeePersonal::all();
        return view('hris::database.photosign.index', compact('emppersonals'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'employee_id' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (!$request->hasFile('photo') && !$request->hasFile('signature')) {
            return back()->withErrors(['photo' => 'You must upload at least a photo or a signature.'])->withInput();
        }

        try {
            $fileUploadService = new FileUploadService();
            $employee = Employee::where('employee_id', $request->employee_id)->first();

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoPath = $fileUploadService->upload($photo, 'photo', ['type' => 'webp','size' => ['width' => 128, 'height' => 148], 'previous' => $employee->photo]);
                $employee->photo = $photoPath['path'];
            }

            if ($request->hasFile('signature')) {
                $signature = $request->file('signature');
                $signaturePath = $fileUploadService->upload($signature, 'signature', ['type' => 'webp','size' => ['width' => 300, 'height' => 150], 'previous' => $employee->signature]);
                $employee->signature = $signaturePath['path'];

            }

            $employee->save();
            return redirect()->back()->with('success', 'Photo and signature updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function info(Request $request) {
        $employee = Employee::with(['designation:id,designation','department:id,department','employeePersonal:employee_id,mobile,national_id,birth_certificate'])
                ->where('employee_id', $request->employee_id)
                ->select('id','employee_id','name','designation_id','department_id','joining_date','photo','signature')
                ->first();
        return response()->json($employee);
    }
}
