<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index() {
        return view('admin.partners.index', ['partners' => Partner::orderBy('order')->get()]);
    }

    public function create() {
        return view('admin.partners.form', ['partner' => new Partner]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name'   => 'required|max:255',
            'logo'   => 'required|image|mimes:jpg,jpeg,png,webp,svg,gif|max:2048',
            'url'    => 'nullable|url|max:500',
            'order'  => 'nullable|integer',
            'status' => 'nullable|in:active,inactive',
        ]);
        $data['logo'] = $request->file('logo')->store('partners', 'public');
        Partner::create($data);
        return redirect()->route('admin.partners.index')->with('success', 'Partner added.');
    }

    public function edit(Partner $partner) {
        return view('admin.partners.form', compact('partner'));
    }

    public function update(Request $request, Partner $partner) {
        $data = $request->validate([
            'name'   => 'required|max:255',
            'logo'   => 'nullable|image|mimes:jpg,jpeg,png,webp,svg,gif|max:2048',
            'url'    => 'nullable|url|max:500',
            'order'  => 'nullable|integer',
            'status' => 'nullable|in:active,inactive',
        ]);
        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($partner->logo);
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }
        $partner->update($data);
        return redirect()->route('admin.partners.index')->with('success', 'Partner updated.');
    }

    public function destroy(Partner $partner) {
        Storage::disk('public')->delete($partner->logo);
        $partner->delete();
        return back()->with('success', 'Partner deleted.');
    }
}
