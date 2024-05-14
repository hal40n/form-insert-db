<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MajorCategory;
use App\Models\MinorCategory;
use App\Models\Invoice;

class InvoiceController extends Controller
{

    public function create()
    {
        $major_categories = MajorCategory::all();
        $minor_categories = MinorCategory::all();
        return view('form', compact('major_categories', 'minor_categories'));
    }

    public function store(Request $request)
    {
        if($request->new_major_category) {
            $existingMajorCategory = MajorCategory::where('major_category_name', $request->new_major_category)->first();
        } else {
            $existingMajorCategory = NULL;
        }

        if (!$existingMajorCategory == NULL) {
            $newMajorCategory = MajorCategory::create(['major_category_name' => $request->new_major_category]);
            $major_category_id = $newMajorCategory->id;
        } else {
            $existingMajorCategory = MajorCategory::where('id', $request->major_category_id)->first();
            $major_category_id = $existingMajorCategory->id;
        }


        $minorCategory = MinorCategory::firstOrCreate(
            ['minor_category_name' => $request->minor_category_name]
        );

        // インボイスのデータを保存
        Invoice::create([
            'major_category_id' => $major_category_id,
            'minor_category_id' => $minorCategory->id,
            'quantity' => $request->quantity,
            'amount' => $request->amount,
        ]);

        return redirect()->route('invoices.create')->with('success', 'データが登録されました');
    }

}