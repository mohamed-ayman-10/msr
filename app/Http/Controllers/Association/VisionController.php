<?php

namespace App\Http\Controllers\Association;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\Value;
use Illuminate\Http\Request;

class VisionController extends Controller
{
    public function index()
    {
        try {
            $data = Association::query()->with('values')->where('primary_title', 'vision')->first();
            return view('admin.pages.association.vision.index', compact('data'));

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
                'title' => 'required'
            ], [
                'title.required' => 'لا يمكن ان يكون القيمة فارغا'
            ]);

            $value = new Value();
            $value->association_id = $request->id;
            $value->title = $request->title;
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
                'vision' => 'required',
                'message' => 'required'
            ], [
                'title.required' => 'لا يمكن ان يكون العنوان فارغا',
                'vision.required' => 'لا يمكن ان تكون الرؤية فارغة',
                'message.required' => 'لا يمكن ان تكون الرسالة فارغة',
            ]);
            Association::query()->where('primary_title', 'vision')->update([
                'title' => $request->title,
                'vision' => $request->vision,
                'message' => $request->message,
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
                'title' => 'required'
            ], [
                'title.required' => 'لا يمكن ان تكون القيمة فارغة'
            ]);

            $value = Value::query()->findOrFail($id);
            $value->title = $request->title;
            $value->save();

            return back()->with('success', 'تم التعديل بنجاح');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
                Value::destroy($id);

            return back()->with('success', 'تم الحذف بنجاح');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
