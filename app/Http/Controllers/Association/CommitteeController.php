<?php

namespace App\Http\Controllers\Association;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\Image;
use App\Models\Plan;
use App\Models\Value;
use Illuminate\Http\Request;

class CommitteeController extends Controller
{
    public function index()
    {
        try {
            $data = Association::query()->with('images')->where('primary_title', 'committee')->first();
            return view('admin.pages.association.committee.index', compact('data'));

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'pdf' => 'required',
            ], [
                'pdf.required' => 'برجاء ادخال pdf',
            ]);

            $image = new Image();
            $image->association_id = $request->id;
            $image->path = fileUpload('admin/images/committee', $request->file('pdf'));
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
            Association::query()->where('primary_title', 'committee')->update([
                'title' => $request->title,
            ]);
            return back()->with('success', 'تم التعديل بنجاح');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'pdf' => 'required',
            ], [
                'pdf.required' => 'برجاء ادخال pdf',
            ]);

            $image = Image::query()->findOrFail($id);
            fileDelete($image->path);
            $image->path = fileUpload('admin/images/committee', $request->file('pdf'));
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
