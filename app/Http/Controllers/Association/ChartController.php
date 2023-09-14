<?php

namespace App\Http\Controllers\Association;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\Image;
use App\Models\Plan;
use App\Models\Value;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        try {
            $data = Association::query()->with('images')->where('primary_title', 'chart')->first();
            return view('admin.pages.association.chart.index', compact('data'));

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
                'image' => 'required',
            ], [
                'image.required' => 'برجاء ادخال صورة',
            ]);

            $image = new Image();
            $image->association_id = $request->id;
            $image->path = fileUpload('admin/images/chart', $request->file('image'));
            $image->save();

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
            Association::query()->where('primary_title', 'chart')->update([
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
                'image' => 'required',
            ], [
                'image.required' => 'برجاء ادخال صورة',
            ]);

            $image = Image::query()->findOrFail($id);
            fileDelete($image->path);
            $image->path = fileUpload('admin/images/chart', $request->file('image'));
            $image->save();

            return back()->with('success', 'تم التعديل بنجاح');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $image = Image::query()->findOrFail($id);
            fileDelete($image->path);
            $image->delete();

            return back()->with('success', 'تم الحذف بنجاح');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
