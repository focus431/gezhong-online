<?php

// BlogController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;
// ...

class BlogController extends Controller
{
    // 顯示博客列表
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blog', compact('blogs'));
    }



    // 存儲新博客
    public function create()
    {
        // 顯示新增博客的表單
        return view('admin.add-blog');
    }

    public function store(Request $request)
    {
        Log::info($request->all());
        // 驗證請求數據
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:active,inactive',
            'category' => 'required', // 添加验证规则
            'sub_category' => 'required', // 添加验证规则
            'image' => 'required|image|max:50000', // 最大50MB
        ]);

        // 處理上傳的圖片文件
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('blog_images', 'public');
        }

        // 使用 updateOrCreate 方法更新或創建新的博客
        $blog = Blog::updateOrCreate(
            ['name' => $validatedData['name']], // 用於檢查的字段
            $validatedData // 更新或創建的數據
        );
        return response()->json([
            'success' => true,
            'message' => 'Blog published successfully.',
            'blog' => $blog
        ]);
    }

    // 顯示單個博客
    public function show(Blog $blog)
    {
        return view('admin.blog-details', compact('blog'));
    }

    // 顯示編輯博客的表單
    public function edit(Blog $blog)
    {
        return view('admin.edit-blog', compact('blog'));
    }

    // 更新博客
    public function update(Request $request, Blog $blog)
    {
        Log::info($request->all());

        // 驗證請求數據
        $validatedData = $request->validate([
            'name' => 'sometimes|required|max:255',
            'description' => 'sometimes|required',
            'status' => 'sometimes|required|in:active,inactive',
            'category' => 'sometimes|required',
            'sub_category' => 'sometimes|required',
            'image' => 'sometimes|image|max:50000', // 如果提供了圖片，則驗證圖片
        ]);

        // 處理上傳的圖片文件，如果有的話
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('blog_images', 'public');
        }

        // 更新現有的博客記錄
        $blog->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Blog updated successfully.',
            'blog' => $blog
        ]);
    }

    // 刪除博客
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        // 可选：返回一个重定向或 JSON 响应，取决于您的需求
        return redirect()->route('admin.blog')->with('success', 'Blog deleted successfully.');
    }
}
