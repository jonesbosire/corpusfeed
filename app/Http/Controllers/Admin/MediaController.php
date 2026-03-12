<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class MediaController extends Controller {
    public function upload(Request $request) {
        $request->validate(['file' => 'required|file|mimes:jpg,jpeg,png,gif,webp,svg|max:5120']);
        $path = $request->file('file')->store('media', 'public');
        return response()->json(['url' => Storage::disk('public')->url($path), 'path' => $path]);
    }
}
