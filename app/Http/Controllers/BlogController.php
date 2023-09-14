<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.pages.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.pages.blog.create');
    }

    public function store(StoreBlogRequest $request)
    {
        try {
            $validatedData = $request->validated();
            if ($request->hasFile('image')) {
                $validatedData['image'] = fileUpload('admin/images/blog', $request->file('image'));
            }
            Blog::query()->create($validatedData);
            return redirect()->route('blog.index')->with('success', 'تم إضافة الخبر بنجاح');

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function show(Blog $blog)
    {
        return view('admin.pages.blog.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('admin.pages.blog.edit', compact('blog'));
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        try {
            $validatedData = $request->validated();
            if ($request->hasFile('image')) {
                fileDelete($blog->image);
                $validatedData['image'] = fileUpload('admin/images/blog', $request->file('image'));
            }
            $blog->update($validatedData);
            return redirect()->route('blog.index')->with('success', 'تم تعديل الخبر بنجاح');

        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy(Blog $blog)
    {
        fileDelete($blog->image);
        $blog->delete();
        return redirect()->route('blog.index')->with('success', 'تم حذف الخبر بنجاح');
    }
}
