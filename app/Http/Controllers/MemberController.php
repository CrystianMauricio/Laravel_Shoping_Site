<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;


class MemberController extends Controller
{
    public function index()
    {
    	$user = User::all();
        
    	return view('administrator/member/member', compact('user'));
    }
    public function store(Request $requset)
    {
    	
    }
    public function destroy($id)
    {
        $detail = User::find($id); 

        $detail->delete();

        return redirect()->route('member.index');
    }
    public function allow($id)
    {
        $user = User::find($id); 

        if ($user) {
            $user->update(['active' => 'true']);
        }

        return redirect()->route('member.index');
    }
}
