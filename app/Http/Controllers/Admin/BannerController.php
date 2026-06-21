<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()
            ->paginate(20);

        return view(
            'admin.banners.index',
            compact('banners')
        );
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer'
        ]);

        $image = null;

        if ($request->hasFile('image')) {

            $image = $request
                ->file('image')
                ->store('banners', 'public');
        }

        Banner::create([
            'image' => $image,
            'url' => $request->url,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->has('status')
        ]);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Thêm banner thành công');
    }

    public function edit(Banner $banner)
    {
        return view(
            'admin.banners.edit',
            compact('banner')
        );
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer'
        ]);

        $image = $banner->image;

        if ($request->hasFile('image')) {

            if (
                $banner->image &&
                Storage::disk('public')->exists($banner->image)
            ) {
                Storage::disk('public')
                    ->delete($banner->image);
            }

            $image = $request
                ->file('image')
                ->store('banners', 'public');
        }

        $banner->update([
            'image' => $image,
            'url' => $request->url,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->has('status')
        ]);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Cập nhật banner thành công');
    }

    public function destroy(Banner $banner)
    {
        if (
            $banner->image &&
            Storage::disk('public')->exists($banner->image)
        ) {
            Storage::disk('public')
                ->delete($banner->image);
        }

        $banner->delete();

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Xóa banner thành công');
    }
}
