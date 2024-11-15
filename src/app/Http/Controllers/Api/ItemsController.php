<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
        try {
            $items = Items::getItems();
            if ($items->isEmpty()) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Items not found',
                    'data' => null
                ], 404);
            } else {
                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                    'data' => $items
                ]);
            }
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'quantity' => 'required',
                'category_id' => 'required',
                'supplier_id' => 'required',
            ]);

            $admin = Admin::first();

            if ($admin) {
                $item = Items::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'quantity' => $request->quantity,
                    'category_id' => $request->category_id,
                    'supplier_id' => $request->supplier_id,
                    'created_by' => $admin->id
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'success',
                    'data' => $item
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Admin not found'
                ], 404);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Database error',
                'error' => $e->getMessage()
            ], 500);
         } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
