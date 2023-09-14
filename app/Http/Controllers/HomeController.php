<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Image;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = Home::query()->with('images')->first();
        return view('admin.pages.home.index', compact('data'));
    }

    public function storeImage(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required'
            ], [
                'image.required' => 'برجاء ادخال صورة'
            ]);

            $image = new Image();
            $image->home_id = $request->home_id;
            $image->path = fileUpload('admin/images/slider', $request->file('image'));
            $image->save();

            return back()->with('success', 'تم إضافة الصورة بنجاح');
        } catch (\Exception $e) {
            return back()->withErrors(['eeror' => $e->getMessage()]);
        }
    }

    public function updateImage(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required'
            ], [
                'image.required' => 'برجاء ادخال صورة'
            ]);

            $image = Image::query()->where('id', $request->id)->first();
            fileDelete($image->path);
            $image->path = fileUpload('admin/images/slider', $request->file('image'));
            $image->save();

            return back()->with('success', 'تم تعديل الصورة بنجاح');
        } catch (\Exception $e) {
            return back()->withErrors(['eeror' => $e->getMessage()]);
        }
    }

    public function deleteImage($id)
    {
        try {

            $image = Image::query()->where('id', $id)->first();
            fileDelete($image->path);
            $image->delete();

            return back()->with('success', 'تم حذف الصورة بنجاح');
        } catch (\Exception $e) {
            return back()->withErrors(['eeror' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'who_are_we_title' => 'required',
                'who_are_we_description' => 'required',
            ], [
                'who_are_we_title.required' => 'برجاء ادخال العنوان',
                'who_are_we_description.required' => 'برجاء ادخال الوصف',
            ]);

            $home = Home::query()->first();
            $home->who_are_we_title = $request->who_are_we_title;
            $home->who_are_we_description = $request->who_are_we_description;
            if ($request->hasFile('video')) {
                fileDelete($home->who_are_we_video);
                $home->who_are_we_video = fileUpload('admin/images/video', $request->file('video'));
            }
            $home->save();


            return back()->with('success', 'تم حذف الصورة بنجاح');
        } catch (\Exception $e) {
            return back()->withErrors(['eeror' => $e->getMessage()]);
        }
    }
}
