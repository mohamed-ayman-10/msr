<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::query()->orderBy('order', 'ASC')->get();
        return view('admin.pages.menu.index', compact('menus'));
    }

    public function create()
    {
        //
    }

    public function store(MenuRequest $request)
    {
        try {
            $menu = new Menu();
            $menu->title = $request->title;
            if ($request->order) {
                $menu->order = $request->order;
            }
            $menu->save();
            return back()->with('success', 'تم إضافة القائمة بنجاح');
        } catch (\Exception $e) {
            return back()->withErrors(['eeror' => $e->getMessage()]);
        }
    }

    public function show(Menu $menu)
    {
        //
    }

    public function edit(Menu $menu)
    {
        //
    }

    public function update(Request $request, Menu $menu)
    {
        try {
            $menu->title = $request->title;
            $menu->order = $request->order;
            $menu->save();
            return back()->with('success', 'تم تعديل القائمة بنجاح');
        } catch (\Exception $e) {
            return back()->withErrors(['eeror' => $e->getMessage()]);
        }
    }

    public function destroy(Menu $menu)
    {
        try {
            $menu->delete();
            return back()->with('success', 'تم حذف القائمة بنجاح');
        } catch (\Exception $e) {
            return back()->withErrors(['eeror' => $e->getMessage()]);
        }
    }
}
