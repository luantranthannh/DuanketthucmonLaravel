<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\File;
class AdminBanners extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banners.banners', compact('banners'));
    }
    public function create()
    {
        return view('admin.banners.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $extension = $file->getClientOriginalExtension();
            $path = 'assets/admin/banners/';
            $filename = time() . '.' . $extension;
            $file->move($path, $filename);
        }

        $banner = new Banner;
        $banner->name = $filename;
        $banner->image_path = $filename;
        $banner->save();

        return redirect('admin/banners')->with('status', 'Thêm banners thành công.');
    }
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('admin.banners.update', compact('banner')); }


     public function update(Request $request, string $id)
{
    $banner = Banner::find($id);

    $validateData = Validator::make(
        $request->all(),
        [
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]
    );

    
    if ($request->hasFile('banner_image')) {
        $image_path = public_path("assets/admin/banners/{$banner->image_path}");

        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $image = $request->file('banner_image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('assets/admin/banners/'), $imageName);
        $banner->image_path = $imageName;
    }
    $banner->save();

    return redirect('admin/banners')->with('status', 'Cập nhật sản phẩm thành công.');
}


  public function destroy($id){
    $banner = Banner::findOrFail($id);

    if (File::exists($banner->image_path)) {
        File::delete($banner->image_path);
    }
    $banner->delete();
    return redirect()->back()->with('status', 'Thêm sản phẩm thành công');
  }

}