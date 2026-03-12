<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class TeamMemberController extends Controller {
    public function index() { return view('admin.team.index', ['members' => TeamMember::orderBy('order')->get()]); }
    public function create() { return view('admin.team.form', ['member' => new TeamMember]); }
    public function store(Request $request) {
        $data = $request->validate(['name' => 'required|max:100', 'role' => 'required|max:100', 'bio' => 'nullable', 'email' => 'nullable|email', 'linkedin' => 'nullable|url', 'twitter' => 'nullable', 'photo' => 'nullable|image|max:2048', 'order' => 'nullable|integer', 'status' => 'nullable|in:active,inactive']);
        if ($request->hasFile('photo')) $data['photo'] = $request->file('photo')->store('team', 'public');
        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member added.');
    }
    public function edit(TeamMember $team) { return view('admin.team.form', ['member' => $team]); }
    public function update(Request $request, TeamMember $team) {
        $data = $request->validate(['name' => 'required|max:100', 'role' => 'required|max:100', 'bio' => 'nullable', 'email' => 'nullable|email', 'linkedin' => 'nullable|url', 'twitter' => 'nullable', 'photo' => 'nullable|image|max:2048', 'order' => 'nullable|integer', 'status' => 'nullable|in:active,inactive']);
        if ($request->hasFile('photo')) {
            if ($team->photo) Storage::disk('public')->delete($team->photo);
            $data['photo'] = $request->file('photo')->store('team', 'public');
        } elseif ($request->boolean('remove_photo') && $team->photo) {
            Storage::disk('public')->delete($team->photo);
            $data['photo'] = null;
        }
        $team->update($data);
        return redirect()->route('admin.team.index')->with('success', 'Team member updated.');
    }
    public function destroy(TeamMember $team) { if ($team->photo) Storage::disk('public')->delete($team->photo); $team->delete(); return back()->with('success', 'Member deleted.'); }
    public function show(TeamMember $team) { return redirect()->route('admin.team.index'); }
    public function toggle(TeamMember $team) {
        $team->update(['status' => $team->status === 'active' ? 'inactive' : 'active']);
        return response()->json(['status' => $team->status]);
    }
}
