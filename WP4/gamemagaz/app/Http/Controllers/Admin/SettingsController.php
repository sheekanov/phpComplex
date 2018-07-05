<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings', ['email' => Setting::find(1)->value]);
    }

    public function send(Request $request)
    {

        $this->validate($request, ['email' => 'required|email']);
        $setting = Setting::find(1);
        $setting->value = $request->all()['email'];
        $setting->save();

        return redirect(route('admin'));
    }
}
