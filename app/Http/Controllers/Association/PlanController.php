<?php

namespace App\Http\Controllers\Association;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\Plan;
use App\Models\Value;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        try {
            $data = Association::query()->with('plans')->where('primary_title', 'plan')->first();
            return view('admin.pages.association.plan.index', compact('data'));

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'name' => 'required',
                'pdf' => 'required',
            ], [
                'title.required' => 'برجاء اختيار خطة',
                'name.required' => 'لا يمكن ان يكون العنوان فارغا',
                'pdf.required' => 'برجاء ادخال pdf',
            ]);

            $value = new Plan();
            $value->association_id = $request->id;
            $value->title = $request->title;
            $value->name = $request->name;
            $value->pdf = fileUpload('admin/images/plans', $request->file('pdf'));
            $value->save();

            return back()->with('success', 'تم الاضافه بنجاح');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function postAssociation(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
            ], [
                'title.required' => 'لا يمكن ان يكون العنوان فارغا',
            ]);
            Association::query()->where('primary_title', 'plan')->update([
                'title' => $request->title,
            ]);
            return back()->with('success', 'تم التعديل بنجاح');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'title' => 'required',
                'name' => 'required',
            ], [
                'title.required' => 'برجاء اختيار خطة',
                'name.required' => 'لا يمكن ان يكون العنوان فارغا',
            ]);

            $value = Plan::query()->findOrFail($id);
            $value->title = $request->title;
            $value->name = $request->name;

            if($request->hasFile('pdf')) {
                fileDelete($value->pdf);
                $value->pdf = fileUpload('admin/images/plans', $request->file('pdf'));
            }

            $value->save();

            return back()->with('success', 'تم التعديل بنجاح');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $value = Plan::query()->findOrFail($id);
            fileDelete($value->pdf);
            $value->delete();

            return back()->with('success', 'تم الحذف بنجاح');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
