<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubMenuRequest;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SubMenuController extends Controller
{
    public function index()
    {
        $subMenus = SubMenu::query()->paginate(10);
        return view('admin.pages.sub menu.index', compact('subMenus'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('admin.pages.sub menu.create', compact('menus'));
    }

    public function store(SubMenuRequest $request)
    {
        try {

            $subMenu = new SubMenu();

            if ($request->check == 'pdf') {
                $request->validate([
                    'pdf' => 'required',
                ], [
                    'pdf.required' => 'برجاء ادخال ملف pdf',
                ]);
                $subMenu->pdf = fileUpload('admin/images/pdf', $request->pdf);
            }
            if ($request->check == 'ckeditor') {
                $request->validate([
                    'content' => 'required'
                ], [
                    'content.required' => 'برجاء ادخار محتوي للصفحة',
                ]);
                $subMenu->content = $request->content;
            }
            $subMenu->title = $request->title;
            $subMenu->menu_id = $request->menu;
            $subMenu->save();
            return redirect()->route('sub-menu.index')->with('success', 'تم إضافة الصفحة بنجاح');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function upload(Request $request): JsonResponse
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move('admin/images', $fileName);

            $url = asset('admin/images/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }

    public function show(SubMenu $subMenu)
    {
        return view('admin.pages.sub menu.show', compact('subMenu'));
    }

    public function edit(SubMenu $subMenu)
    {
        $menus = Menu::all();
        return view('admin.pages.sub menu.edit', compact('subMenu', 'menus'));
    }

    public function update(SubMenuRequest $request, SubMenu $subMenu)
    {
        try {
            if ($request->pdf) {
                $request->validate([
                    'pdf' => 'required',
                ], [
                    'pdf.required' => 'برجاء ادخال ملف pdf',
                ]);
                fileDelete($subMenu->pdf);
                $subMenu->pdf = fileUpload('admin/images/pdf', $request->pdf);
            }
            if ($request->content) {
                $request->validate([
                    'content' => 'required'
                ], [
                    'content.required' => 'برجاء ادخار محتوي للصفحة',
                ]);
                $subMenu->content = $request->content;
            }
            $subMenu->title = $request->title;
            $subMenu->menu_id = $request->menu;
            $subMenu->save();
            return redirect()->route('sub-menu.index')->with('success', 'تم تعديل الصفحة بنجاح');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(SubMenu $subMenu)
    {
        try {
            fileDelete($subMenu->pdf);
            $subMenu->delete();
            return redirect()->route('sub-menu.index')->with('success', 'تم حذف الصفحة بنجاح');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
