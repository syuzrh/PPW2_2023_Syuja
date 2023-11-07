<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Please login to access the dashboard.',
                ])->onlyInput('email');
        }

        $user = User::all();
        return view('dashboard.index')->with(compact('user'));
    }

    public function edit(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Please login to access the dashboard.',
                ])->onlyInput('email');
        }
        $user = User::where('id', $request->route('id'))->first();
        return view('dashboard.edit')->with(compact('user'));
    }

    public function sendEdit(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Please login to access the dashboard.',
                ])->onlyInput('email');
        }
        $this->validate($request, [
            'image'     => 'image|mimes:jpeg,jpg,png|max:2048',
            'name'     => 'required|min:5',
            'email'   => 'required|max:200'
        ]);
        $userToUpdate = User::findOrFail($request->route('id'));

        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();

            $time = time();
            $filenametostore = $filename.'_'.$time.'.'.$extension;
            $thumb = 'thumb_'.$filenametostore;
            $square = 'square_'.$filenametostore;

            $request->file('photo')->storeAs('profile', $filenametostore);
            $request->file('photo')->storeAs('profile/thumbnail', $square);
            $smallthumbnailpath = storage_path('app/profile/thumbnail/'.$square);
            $this->createThumbnail($smallthumbnailpath, 150, 93);

            $mediumthumbnailpath = storage_path('app/profile/thumbnail/'.$square);
            $this->createSquare($mediumthumbnailpath, 300, 300);


            Storage::delete('photos' . $userToUpdate->photo);
            $userToUpdate->update([
                'photo'     => $filenametostore,
                'name'     => $request->name,
                'email'   => $request->email
            ]);
        } else {
            $userToUpdate->update([
                'name'     => $request->name,
                'email'   => $request->email
            ]);
        }
        return redirect('/image')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function createThumbnail($path, $width, $height)
{
    try {
        if (file_exists($path)) {
            $img = Image::make($path)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($path);
        } else {
            dd('File not found: ' . $path);
        }
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
}

public function createSquare($path, $width, $height)
{
    try {
        if (file_exists($path)) {
            $img = Image::make($path)->resize($width, $height);
            $img->save($path);
        } else {
            dd('File not found: ' . $path);
        }
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
}

}
