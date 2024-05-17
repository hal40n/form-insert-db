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

        $this->validate($request, [
            'minor_category_name' => 'required',
            'quantity' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        $majorCategory = $request->major_category_id;
        $newMajorCategory = $request->new_major_category;

        # 新しく追加されたカテゴリの存在チェック
        $result = null;
        if ($newMajorCategory) {
            $result = MajorCategory::where('major_category_name', $newMajorCategory)->first();
        }

        if ($newMajorCategory && !$result) {
            $newMajorCategory = MajorCategory::create(['major_category_name' => $newMajorCategory]);
            $major_category_id = $newMajorCategory->id;
        } else {
            $existingMajorCategory = MajorCategory::where('id', $majorCategory)->first();
            $major_category_id = $existingMajorCategory ? $existingMajorCategory->id : null;
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