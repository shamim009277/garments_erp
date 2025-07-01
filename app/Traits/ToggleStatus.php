<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait ToggleStatus
{
    public function toggleStatusTrait(Request $request, $modelClass, $statusColumn = 'is_active')
    {
        try {
            $model = $modelClass::findOrFail($request->id);
            $model->update([$statusColumn => $request->status]);

            return response()->json([
                'success' => true,
                'message' => class_basename($modelClass) . ' status updated successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => class_basename($modelClass) . ' status update failed: ' . $e->getMessage(),
            ]);
        }
    }
}
