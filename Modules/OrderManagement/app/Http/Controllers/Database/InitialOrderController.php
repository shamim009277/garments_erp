<?php

namespace Modules\OrderManagement\Http\Controllers\Database;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\OrderManagement\Models\Database\InitialOrder;
use Modules\OrderManagement\Models\Setup\Buyer;
use Modules\OrderManagement\Models\Setup\Color;
use Modules\OrderManagement\Models\Setup\Size;
use Modules\OrderManagement\Models\Setup\OrderType;
use Modules\OrderManagement\Models\Setup\YarnCount;
use Modules\OrderManagement\Models\Setup\ProductCategory;
use Modules\HRIS\Models\Database\Employee;
use Modules\HRIS\Models\Setup\Organization;
use Modules\OrderManagement\Http\Requests\Database\InitialOrderRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\ToggleStatus;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class InitialOrderController extends Controller
{
    use ToggleStatus;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = InitialOrder::with(['buyer', 'organization', 'colors', 'sizes', 'orderType', 'merchant', 'yarnCount', 'productCategory'])->get();
        // return $orders;
        $buyers = Buyer::all();
        $organizations = Organization::all();
        $colors = Color::all();
        $sizes = Size::all();
        $orderTypes = OrderType::all();
        $merchants = Employee::where('department_id',15)->get();
        $yarnCounts = YarnCount::all();
        $productCategories = ProductCategory::all();
        // return $yarnCounts;
        return view('ordermanagement::database.initialorders.index', compact('orders', 'buyers', 'organizations', 'colors', 'sizes', 'orderTypes', 'merchants', 'yarnCounts', 'productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buyers = Buyer::all();
        $organizations = Organization::all();
        $colors = Color::all();
        $sizes = Size::all();
        $orderTypes = OrderType::all();
        $merchants = Employee::all();
        $yarnCounts = YarnCount::all();
        $productCategories = ProductCategory::all();
        
        return view('ordermanagement::database.initialorders.create', compact(
            'buyers', 'organizations', 'colors', 'sizes', 'orderTypes', 
            'merchants', 'yarnCounts', 'productCategories'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InitialOrderRequest $request)
    {
        DB::beginTransaction();
        try {

            $lastid = InitialOrder::orderBy('id','DESC')->where('organization_id','=',$request->organization_id)->pluck('order_code')->first(); 
            if(!empty($lastid)){
                $lastid = substr($lastid,4,7)+1;                   
            }else{
                $lastid = 1;
            }
            $order_code = 'ORD' . str_pad($lastid,7, '0', STR_PAD_LEFT);
            $file_path = null;
            if($request->file('file')){
                $imageName = 'initialorder'.time().'-'.mt_rand().'.'.$request->file->extension();
                $fileName = 'frontend/uploads/images/initialorders/'.$imageName;
                $request->file->move(public_path('frontend/uploads/images/initialorders/'), $imageName);
                $file_path = $fileName;
            }
            $order = InitialOrder::create([
                'order_code' => $order_code,
                'buyer_id' => $request->buyer_id,
                'description' => $request->description,
                'organization_id' => $request->organization_id,
                'order_quantity' => $request->order_quantity,
                'style' => $request->style,
                'gsm' => $request->gsm,
                'po' => $request->po,
                'seasson' => $request->seasson,
                'fabrication' => $request->fabrication,
                'finish_type' => $request->finish_type,
                'instructions' => $request->instructions,
                'order_type_id' => $request->order_type_id,
                'merchant_id' => $request->merchant_id,
                'yarn_count_id' => $request->yarn_count_id,
                'product_category_id' => $request->product_category_id,
                'file' => $file_path,
            ]);
            
            if ($request->has('color_id')) {
                $order->colors()->attach($request->color_id);
            }
            if ($request->has('size_id')) {
                $order->sizes()->attach($request->size_id);
            }
            
            DB::commit();
            return redirect()->route('ordermanagement.database.initialorders.index')->with('success', 'Initial Order created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create initial order: ' . $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $order = InitialOrder::with(['buyer', 'organization', 'colors', 'sizes', 'orderType', 'merchant', 'yarnCount', 'productCategory'])->findOrFail($id);
        return view('ordermanagement::database.initialorders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = InitialOrder::findOrFail($id);
        $buyers = Buyer::all();
        $organizations = Organization::all();
        $colors = Color::all();
        $sizes = Size::all();
        $orderTypes = OrderType::all();
        $merchants = Employee::all();
        $yarnCounts = YarnCount::all();
        $productCategories = ProductCategory::all();
        
        return view('ordermanagement::database.initialorders.edit', compact(
            'order', 'buyers', 'organizations', 'colors', 'sizes', 'orderTypes', 
            'merchants', 'yarnCounts', 'productCategories'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InitialOrderRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $order = InitialOrder::findOrFail($id);

            $data = [
                'buyer_id' => $request->buyer_id,
                'description' => $request->description,
                'organization_id' => $request->organization_id,
                'order_quantity' => $request->order_quantity,
                'style' => $request->style,
                'gsm' => $request->gsm,
                'po' => $request->po,
                'seasson' => $request->seasson,
                'fabrication' => $request->fabrication,
                'finish_type' => $request->finish_type,
                'instructions' => $request->instructions,
                'order_type_id' => $request->order_type_id,
                'merchant_id' => $request->merchant_id,
                'yarn_count_id' => $request->yarn_count_id,
                'product_category_id' => $request->product_category_id,
            ];


            if($request->file('file')){
                @unlink($order->file);
                $imageName = 'initialorder'.time().'-'.mt_rand().'.'.$request->file->extension();
                $fileName = 'frontend/uploads/images/initialorders/'.$imageName;
                $request->file->move(public_path('frontend/uploads/images/initialorders/'), $imageName);
                $data['file'] = $fileName;
            }
           

            $order->update($data);
            
            if ($request->has('color_id')) {
                $order->colors()->sync($request->color_id);
            }
            if ($request->has('size_id')) {
                $order->sizes()->sync($request->size_id);
            }
            
            DB::commit();
            return redirect()->route('ordermanagement.database.initialorders.index')->with('success', 'Initial Order updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update initial order: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $order = InitialOrder::findOrFail($id);
            $order->delete();
            DB::commit();
            return redirect()->route('ordermanagement.database.initialorders.index')->with('success', 'Initial Order deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete initial order: ' . $e->getMessage());
        }
    }


    public function pdfData($id){

        date_default_timezone_set('Asia/Dhaka');

        $order = InitialOrder::with(['buyer', 'organization', 'colors', 'sizes', 'orderType', 'merchant', 'yarnCount', 'productCategory'])->findOrFail($id);
        $title = 'Initial Order';
        $pdf = Pdf::loadView('ordermanagement::database.initialorders.pdf', compact('order','title'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('initialorders.pdf');
    }
}
