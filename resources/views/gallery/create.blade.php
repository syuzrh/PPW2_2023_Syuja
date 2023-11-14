@extends('auth.layouts')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Gambar</div>
                <div class="card-body">
                    <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3 row">
                            <label for="title" class="col-md-4 col-form-label text-md-end text-start">Judul</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="title" name="title">
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="description" class="col-md-4 col-form-label text-md-end text-start">Deskripsi</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="description" rows="5" name="description"></textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="input-file" class="col-md-4 col-form-label text-md-end text-start">Pilih Berkas</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="input-file" name="picture">
                                        <label class="custom-file-label" for="input-file">Pilih berkas</label>
                                    </div>
                                </div>
                                @error('picture')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
