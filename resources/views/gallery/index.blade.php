@extends('auth.layouts')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($galleries as $gallery)
                            <div class="col-sm-2">
                                <div>
                                    <a class="example-image-link" href="{{ $gallery->original_pict }}" data-lightbox="roadtrip" data-title="{{ $gallery->description }}">
                                        <img class="example-image img-fluid mb-2" src="{{ asset('storage/posts_image/' . $gallery->picture) }}" alt="image-{{ $gallery->id }}" />
                                    </a>
                                    <div class="mt-3">
                                        <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-sm-12 text-center">
                                <h3>Tidak ada data.</h3>
                            </div>
                        @endforelse
                    </div>

                    <div class="d-flex">
                        {{ $galleries->links() }}
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('gallery.create') }}" class="btn btn-primary">Tambah Gambar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
