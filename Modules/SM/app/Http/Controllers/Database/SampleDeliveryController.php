<?php

namespace Modules\SM\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\SM\Models\Database\SampleDelivery;
use Modules\SM\Models\Database\SampleDeliveryDetail;
use Modules\OrderManagement\Models\Setup\Buyer;
use Modules\HRIS\Models\Database\Employee;
use Modules\OrderManagement\Models\Database\SampleOrderProgramme;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SampleDeliveryController extends Controller
{
    public function index()
    {
        $buyers = Buyer::where('is_active', 1)->get();
        $deliveries = SampleDelivery::with(['buyer', 'employee'])->orderBy('id', 'desc')->get();
        $employees = Employee::where('is_active', 1)->get();
        
        return view('sm::database.sampledelivery.index', compact('deliveries', 'employees','buyers'));  
    }

    public function create()
    {
        $buyers = Buyer::where('is_active', 1)->get();
        // Assuming we want active employees
        $employees = Employee::where('is_active', 1)->get();
        // Fetch sample programmes that can be delivered. 
        // For now, fetching all active/approved ones might be too many. 
        // Maybe fetch recent ones or let user search.
        // I'll pass all for now, or maybe just pass empty and let them be loaded via AJAX if needed.
        // But for simplicity, I'll pass them.
        $sampleProgrammes = SampleOrderProgramme::where('accept_status', 1)->get();

        return view('sm::database.sampledelivery.create', compact('buyers', 'employees', 'sampleProgrammes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Date' => 'required|date',
            'BuyerID' => 'required|integer',
            'EmployeeID' => 'required|integer',
            'ChallanType' => 'required|integer',
            'GoodsType' => 'required|integer',
           
        ]);

        $time= Carbon::now()->format('Y-m-d');
        $year = date('Y', strtotime($time));
        $yr = date('y', strtotime($time)); 
        $mn = date('m', strtotime($time)); 
        $lastid = SampleDelivery::orderBy('id','DESC')->pluck('ChallanNo')->first(); 
        if(!empty($lastid)){
            $lastid = substr($lastid,6,12)+1;                   
        }else{
            $lastid = 1;
        }
        $challanNo = 'SD'.$yr.str_pad($lastid, 6, "0", STR_PAD_LEFT);

        try {
            DB::beginTransaction();

            $delivery = new SampleDelivery();
            $delivery->ChallanNo = $challanNo;
            $delivery->Date = $request->Date;
            $delivery->BuyerID = $request->BuyerID;
            $delivery->EmployeeID = $request->EmployeeID;
            $delivery->ChallanType = $request->ChallanType;
            $delivery->GoodsType = $request->GoodsType;
            $delivery->Comments = $request->Comments;
            $delivery->C4S = 'A'; // Default Active/Approved? User didn't specify logic for C4S.
            $delivery->CreatedBy = Auth::id();
            $delivery->save();
            DB::commit();
            return redirect()->route('sms.database.sampledelivery.index')->with('success', 'Sample Delivery created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $delivery = SampleDelivery::with(['details.sampleOrderProgramme', 'buyer', 'employee'])->findOrFail($id);
        $buyers = Buyer::where('is_active', 1)->get();
        $deliveries = SampleDelivery::with(['buyer', 'employee'])->orderBy('id', 'desc')->get();
        $employees = Employee::where('is_active', 1)->get();
        $sampleProgrammes = SampleOrderProgramme::where('accept_status', 1)->get();
        
        return view('sm::database.sampledelivery.show', compact('delivery', 'buyers', 'deliveries', 'employees', 'sampleProgrammes'));
    }

    public function edit($id)
    {
        $delivery = SampleDelivery::with('details')->findOrFail($id);
        $buyers = Buyer::where('is_active', 1)->get();
        $employees = Employee::where('is_active', 1)->get();
        $sampleProgrammes = SampleOrderProgramme::where('accept_status', 1)->get();
        return view('sm::database.sampledelivery.edit', compact('delivery', 'buyers', 'employees', 'sampleProgrammes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ChallanNo' => 'required|string|max:30',
            'Date' => 'required|date',
            'BuyerID' => 'required|integer',
            'EmployeeID' => 'required|integer',
            'ChallanType' => 'required|integer',
            'GoodsType' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            $delivery = SampleDelivery::findOrFail($id);
            $delivery->ChallanNo = $request->ChallanNo;
            $delivery->Date = $request->Date;
            $delivery->BuyerID = $request->BuyerID;
            $delivery->EmployeeID = $request->EmployeeID;
            $delivery->ChallanType = $request->ChallanType;
            $delivery->GoodsType = $request->GoodsType;
            $delivery->Comments = $request->Comments;
            $delivery->save();

            // Delete existing details and recreate (Simple approach)
            // Or update existing ones. For simplicity and correctness with ID, I should probably check IDs.
            // But since this is a pair programming task, I'll go with delete-insert for simplicity unless user objects.
            // SampleDeliveryDetail::where('ChallanID', $id)->delete();

            // foreach ($request->details as $detail) {
            //     $deliveryDetail = new SampleDeliveryDetail();
            //     $deliveryDetail->ChallanID = $delivery->id;
            //     $deliveryDetail->SampleOrderProgrammeID = $detail['SampleOrderProgrammeID'];
            //     $deliveryDetail->GoodsType = $request->GoodsType;
            //     $deliveryDetail->ChallanType = $request->ChallanType;
            //     $deliveryDetail->Color = $detail['Color'];
            //     $deliveryDetail->Quantity = $detail['Quantity'];
            //     $deliveryDetail->Comments = $detail['Comments'] ?? '';
            //     $deliveryDetail->C4S = 'A';
            //     $deliveryDetail->CreatedBy = Auth::id();
            //     $deliveryDetail->save();
            // }

            DB::commit();
            return redirect()->route('sms.database.sampledelivery.index')->with('success', 'Sample Delivery updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $delivery = SampleDelivery::findOrFail($id);
            $delivery->details()->delete();
            $delivery->delete();
            return redirect()->route('sms.database.sampledelivery.index')->with('success', 'Sample Delivery deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function getSampleProduction(Request $request)
    {
        $buyerId = $request->input('buyerId');
        $order_id = $request->input('order_id');
        $sampleProduction = SampleProduction::where('BuyerID', $buyerId)->where('OrderID', $order_id)->first();
        return response()->json($sampleProduction);
    }
}
