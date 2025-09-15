<?php

namespace Modules\HRIS\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\HRIS\Models\Setup\LeaveClassification;
use Modules\HRIS\Http\Requests\Setup\LeaveClassificationRequest;
use App\Traits\ToggleStatus;

class LeaveClassificationController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:hris.leave-classification.view')->only('index');
        $this->middleware('permission:hris.leave-classification.add')->only('store');
        $this->middleware('permission:hris.leave-classification.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:hris.leave-classification.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaveclassifications = LeaveClassification::all();
        return view('hris::setup.leaveclassification.index', compact('leaveclassifications'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveClassificationRequest $request) {
      /*   try {
            LeaveClassification::create($request->validated());
            return redirect()->route('hris.setup.leaveclassifications.index')->with('success', 'Leave Classification created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create leave classification: ' . $e->getMessage());
        } */
        try {
            $data = $request->validated();

            // Calculate pay_ratio based on code
            switch (strtoupper($data['code'])) {
                case 'CL':
                    $data['pay_ratio'] = round(365 / 10, 2);
                    break;
                case 'SL':
                    $data['pay_ratio'] = round(365 / 14, 2);
                    break;
                case 'EL':
                    $data['pay_ratio'] = round(365 / 30, 2);
                default:
                    $data['pay_ratio'] = 1.00;
                    break;
            }

            LeaveClassification::create($data);

            return redirect()
                ->route('hris.setup.leaveclassifications.index')
                ->with('success', 'Leave Classification created successfully');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to create leave classification: ' . $e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(LeaveClassificationRequest $request, $id) {
        try {
            LeaveClassification::findOrFail($id)->update($request->validated());
            return redirect()->route('hris.setup.leaveclassifications.index')->with('success', 'Leave Classification updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update leave classification: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            LeaveClassification::findOrFail($id)->delete();
            return redirect()->route('hris.setup.leaveclassifications.index')->with('success', 'Leave Classification deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete leave classification: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Request $request) {
        return $this->ToggleStatusTrait($request, LeaveClassification::class);
    }
}
