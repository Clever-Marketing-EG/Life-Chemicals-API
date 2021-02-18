<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;

class SheetsController extends Controller
{
    public function sheets(Request $request): JsonResponse
    { 
        // dd($request['sheet']);
        $request->validate([
            'sheet' => 'required|max:10000|mimes:doc,docx,pdf',
            'name' => 'required|string|min:3'
        ]);
        $sheetName = $request->name.'_'.time().'.'.$request->sheet->extension();
        $request->sheet->storeAs('public/products_sheets', $sheetName);
        return response()->json([
            "success" => true,
            'sheet_url' => asset('storage/products_sheets/'.$sheetName)
        ]);
    }
}
