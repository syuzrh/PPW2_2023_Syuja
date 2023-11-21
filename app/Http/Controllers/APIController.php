<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function getAllGallery(Request $request)
    {
        $perPage = 10;
        $posts = Post::paginate($perPage);
        $baseUrl = Config::get('app.url');
        $posts->getCollection()->transform(function ($post) use ($baseUrl) {
            $post->picture = $baseUrl . ':8000/storage/posts_image/' . $post->picture;
            return $post;
        });

        return response()->json(['data' => $posts]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'file' => 'image|nullable|max:1999'
        ]);

        $filenameSimpan = 'noimage.png';

        if ($request->hasFile('file')) {
            $filenameSimpan = $this->storePicture($request->file('file'));
        }

        $post = new Post;
        $post->picture = $filenameSimpan;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        return response()->json(['message' => 'Post created successfully', 'data' => $post]);
    }

    private function storePicture($file)
    {
        $filenameWithExt = $file->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $basename = uniqid() . time();
        $filenameSimpan = "{$basename}.{$extension}";
        $file->storeAs('posts_image', $filenameSimpan);

        return $filenameSimpan;
    }

    public function getGalleryById(Request $request)
    {
        $post = Post::find($request->id);
        return response()->json(['data' => $post]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'image|nullable|max:1999'
        ]);

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imagePath = $image->storeAs('posts_image', $image->hashName());

            Storage::delete('posts_image/' . $post->picture);

            $post->picture = $image->hashName();
        }

        $post->update([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);

        return response()->json(['message' => 'Post updated successfully', 'data' => $post]);
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}