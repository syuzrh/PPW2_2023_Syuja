<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Menampilkan daftar resource.
     */
    public function index()
    {
        $data = [
            'id' => "posts",
            'menu' => 'Gallery',
            'galleries' => Post::where('picture', '!=', '')->whereNotNull('picture')->orderBy('created_at', 'desc')->paginate(30),
        ];

        return view('gallery.index')->with($data);
    }

    /**
     * Menampilkan form untuk membuat resource baru.
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Menyimpan resource baru ke penyimpanan.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'image|nullable|max:1999',
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->description = $request->input('description');

        if ($request->hasFile('picture')) {
            $uploadedFile = $request->file('picture');
            $filename = 'post_image/' . uniqid() . time() . '.' . $uploadedFile->getClientOriginalExtension();
            Storage::putFileAs('public', $uploadedFile, $filename);
            $post->picture = basename($filename);
        } else {
            $post->picture = 'noimage.png';
        }

        $post->save();

        return redirect('gallery')->with('success', 'Berhasil menambahkan data baru');
    }

    /**
     * Menampilkan resource yang ditentukan.
     */
    public function show(string $id)
    {
        // Tidak digunakan dalam contoh ini
    }

    /**
     * Menampilkan form untuk mengedit resource.
     */
    public function edit(string $id)
    {
        $gallery = Post::find($id);
        return view('gallery.edit')->with('gallery', $gallery);
    }

    /**
     * Memperbarui resource yang ditentukan di penyimpanan.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'image|nullable|max:1999',
        ]);

        $post = Post::find($id);

        if ($request->hasFile('picture')) {
            // Hapus gambar lama jika ada
            if ($post->picture != 'noimage.png') {
                Storage::delete('public/' . $post->picture);
            }

            // Proses gambar baru
            $uploadedFile = $request->file('picture');
            $filename = 'post_image/' . uniqid() . time() . '.' . $uploadedFile->getClientOriginalExtension();

            Storage::putFileAs('public', $uploadedFile, $filename);

            $post->picture = basename($filename);
        }

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        return redirect('gallery')->with('success', 'Berhasil memperbarui data');
    }

    /**
     * Menghapus resource yang ditentukan dari penyimpanan.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        // Hapus gambar dari penyimpanan
        if ($post->picture != 'noimage.png') {
            Storage::delete('public/' . $post->picture);
        }

        // Hapus data dari database
        $post->delete();

        return redirect('gallery')->with('success', 'Berhasil menghapus data');
    }
}
