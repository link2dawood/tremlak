<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailSetting;
class EmailSettingController extends Controller
{
    public function update(Request $request)
{
    // dd($request->all());
    // Validate request
    $request->validate([
        'email' => 'required|email',
        'address' => 'required|string|max:255',
        'text' => 'required|string',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    // Fetch the first email setting record
    $emailSetting = EmailSetting::firstOrNew([]);

    // Update fields
    $emailSetting->email = $request->email;
    $emailSetting->address = $request->address;
    $emailSetting->text = $request->text;

    // Handle image upload
    if ($request->hasFile('logo')) {
        $picture = $request->file('logo');
        $pictureName = time() . '_' . $picture->getClientOriginalName();
        $picture->move(public_path('uploads/logo/'), $pictureName);

        $picturePath = 'uploads/logo/' . $pictureName;
        $emailSetting->logo = $picturePath; // Update logo only if a new one is uploaded
    }

    // Save updated details
    $emailSetting->save();

    return redirect()->back()->with('success', 'Email details updated successfully!');
}

}
