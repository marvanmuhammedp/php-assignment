<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Customer;
// use App\Models\Invoice;
use Illuminate\Support\Facades\Log;
use App\Actions\Dashboard\ListDashboardData;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $modules = $request->input('modules', ['Customer', 'Invoice']); // fallback to default

        $data = (new ListDashboardData())->handle($modules);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data fetched successfully',
            'data'    => $data,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $type = $request->input('type');
            $className = '\\App\\Actions\\Dashboard\\Create' . ucfirst($type);

            if (!class_exists($className)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid type specified',
                ], 400);
            }

            $action = new $className();
            $result = $action->handle($request);

            return response()->json([
                'status' => 'success',
                'message' => ucfirst($type) . ' created successfully',
                'data' => $result,
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Dashboard store error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create ' . $request->input('type'),
            ], 500);
        }
    }

}
