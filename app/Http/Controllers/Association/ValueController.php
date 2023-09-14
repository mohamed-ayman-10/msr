<?php

namespace App\Http\Controllers\Association;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\Value;
use Illuminate\Http\Request;

class ValueController extends Controller
{
    public function index()
    {
        try {
            $data = Association::query()->with('values')->where('primary_title', 'objective')->first();
            return view('admin.pages.association.value.index', compact('data'));

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
                'value' => 'required'
            ], [
                'value.required' => 'لا يمكن ان يكون الهدف فارغا'
            ]);

            $value = new Value();
            $value->association_id = $request->id;
            $value->title = $request->value;
            $value->save();

            return back()->with('success', 'تم اضافه الهدف بنجاح');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function postAssociation(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required'
            ], [
                'title.required' => 'لا يمكن ان يكون العنوان فارغا'
            ]);
            Association::query()->where('primary_title', 'objective')->update([
                'title' => $request->title,
            ]);
            return back()->with('success', 'تم تغيير العنوان بنجاح');
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
                'value' => 'required'
            ], [
                'value.required' => 'لا يمكن ان يكون الهدف فارغا'
            ]);

            $value = Value::query()->findOrFail($id);
            $value->title = $request->value;
            $value->save();

            return back()->with('success', 'تم تعديل الهدف بنجاح');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
                Value::destroy($id);

            return back()->with('success', 'تم حذف الهدف بنجاح');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
