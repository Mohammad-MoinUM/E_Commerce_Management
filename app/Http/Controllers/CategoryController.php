<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Category;
use \App\Models\Brand;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminAuth');
    }

    public function index()
    {
        $categories = Category::get();
        $columns = ['id','name'];
        return view('admin.pages.category.index',compact('categories','columns'));
    }

    public function add()
    {
        return view('admin.pages.category.add');
    }

    public function store()
    {
        $data = request()->all();
        request()->validate([
            'name'=>'required',
            'image'=>'required',
        ]);
        $storedPath = request('image')->store('category','public');
        $absolutePath = public_path("storage/{$storedPath}");
        try {
            $image = Image::make($absolutePath)->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->save();
        } catch (\Throwable $e) {
            // GD/Imagick not available, keep original uploaded image without resizing
        }
        $imagePath = "/storage/".$storedPath;
        $data = array_merge(
            $data,
            ['image'=>$imagePath]
        );
        Category::create($data);
        return redirect('/admin/category')->with('message','added Successfully');
    }
    
    public function edit(Category $category)
    {
        return view('admin.pages.category.edit',compact('category'));
    }
    
    public function update(Category $category)
    {
        $data = request()->all();
        request()->validate([
            'name'=>'required',
        ]);
        if(request('image')!=null)
        {
            $filePath = public_path().$category->image;
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $storedPath = request('image')->store('category','public');
            $absolutePath = public_path("storage/{$storedPath}");
            try {
                $image = Image::make($absolutePath)->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image->save();
            } catch (\Throwable $e) {
                // GD/Imagick not available, keep original uploaded image without resizing
            }
            $imagePath = "/storage/".$storedPath;
            $data = array_merge(
                $data,
                ['image'=>$imagePath]
            );
        }
        $category->update($data);
        return redirect('/admin/category')->with('message','Updated Successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/admin/category')->with('danger-message','Deleted Successfully');
    }
}
