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
            'galleries' => Post::whereNotNull('picture')
                ->where('picture', '!=', '')
                ->orderBy('created_at', 'desc')
                ->paginate(30),
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

        if ($request->hasFile('picture')) {
            $basename = uniqid() . time();
            $extension = $request->file('picture')->getClientOriginalExtension();
            $filenameSimpan = "{$basename}.{$extension}";
            $path = $request->file('picture')->storeAs('posts_image', $filenameSimpan);
        } else {
            $filenameSimpan = 'noimage.png';
        }

        $post = new Post;
        $post->picture = $filenameSimpan;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        return redirect('gallery')->with('success', 'Berhasil menambahkan data baru');
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
            $this->deleteOldImage($post);

            $uploadedFile = $request->file('picture');
            $filename = 'posts_image/' . uniqid() . time() . '.' . $uploadedFile->getClientOriginalExtension();

            Storage::putFileAs('public', $uploadedFile, $filename);

            $post->picture = basename($filename);
        }

        $this->updatePostData($post, $request);

        return redirect('gallery')->with('success', 'Berhasil memperbarui data');
    }

    /**
     * Menghapus resource yang ditentukan dari penyimpanan.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        $this->deleteOldImage($post);

        $post->delete();

        return redirect('gallery')->with('success', 'Berhasil menghapus data');
    }

    /**
     * Menghapus gambar lama dari penyimpanan jika ada.
     */
    private function deleteOldImage(Post $post)
    {
        if ($post->picture != 'noimage.png') {
            Storage::delete('public/' . $post->picture);
        }
    }

    /**
     * Memperbarui data post berdasarkan request.
     */
    private function updatePostData(Post $post, Request $request)
    {
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();
    }
}
