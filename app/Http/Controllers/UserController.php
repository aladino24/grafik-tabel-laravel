<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index(){
        $response = Http::get('http://localhost:1234/api/getlogin')->json();
        $data = $response['data'];
        // looping $data
        foreach($data as $d){
            // simpan $d['name'] ke variabel agar jadi, array
            $name[] = $d['name'];
            $login[] = $d['login_time'];
            $logout[] = $d['logout_time'];
        }

       
        // kirim data ke view
        return view('index', compact('data'));
    }

    public function delete(Request $request){
        $response = Http::delete('http://localhost:1234/api/deletelogin/'.$request->_id, [
            '_id' => $request->_id,
        ]);

        if($response->json()['status'] == 200){
            return redirect()->back()->with('success', 'Delete Success');
        }else{
            return redirect()->back()->with('error', 'Delete Failed');
        }
        // dd($request->_id);
    }

    public function logout(Request $request){
        
        $response = Http::post('http://localhost:1234/api/logout', [
            '_id' => $request->_id,
        ]);

        if($response->json()['status'] == 200){
            return redirect()->back()->with('success', 'Logout Success');
        }else{
            return redirect()->back()->with('error', 'Logout Failed');
        }

       
    }
}
