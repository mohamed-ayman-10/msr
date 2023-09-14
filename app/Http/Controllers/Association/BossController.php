<?php

namespace App\Http\Controllers\Association;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\Image;
use App\Models\Plan;
use App\Models\Value;
use Illuminate\Http\Request;

class BossController extends Controller
{
    public function index()
    {
        try {
            $data = Association::query()->with('images')->where('primary_title', 'boss')->first();

            return view('admin.pages.association.boss.index', compact('data'));

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function postAssociation(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'address' => 'required',
            ], [
                'title.required' => 'برجاء ادخال عنوان الصفحة',
                'name.required' => 'برجاء ادخال الاسم',
                'email.required' => 'برجاء ادخال البريد الالكتروني',
                'email.email' => 'البريد الالكتروني غير صحيح',
                'phone.required' => 'برجاء ادخال الهاتف',
                'address.required' => 'برجاء ادخال العنوان',
            ]);
            $association = Association::query()->where('primary_title', 'boss')->first();

            $association->update([
                'title' => $request->title,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            if ($request->hasFile('image')) {
                foreach ($association->images as $image) {
                    fileDelete($image->path);
                    $image->delete();
                }
                $image = new Image();
                $image->association_id = $association->id;
                $image->path = fileUpload('admin/images/boss', $request->file('image'));
                $image->save();
            }
            return back()->with('success', 'تم التعديل بنجاح');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
