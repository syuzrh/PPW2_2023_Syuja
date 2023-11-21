@extends('auth.layouts')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Gallery</div>
                <div class="card-body mt-2">
                    <div class="row">
                        @if (count($items) > 0)
                                @foreach ($items as $gallery)
                                <div class="col-sm-4">
                                    <div>
                                        <div class="parent">
                                            <div class="child">
                                                <a class="example-image-link" href="{{ $gallery['picture']}}" data-lightbox="roadtrip" data-title="{{ $gallery ['description'] }}">
                                                    <img class="example-image mb-1 rounded" src="{{$gallery['picture'] }}" alt="image-{{ $gallery ['id'] }}" width="200"/> </a>
                                            </div>
                                        </div>
                                        <div  class="break-word">
                                            <h4>{{ $gallery ['title'] }}</h4>
                                        </div>
                                        <form onsubmit="return confirm('Are you sure?');" action="{{ route('gallery.destroy', ['gallery' => $gallery['id']]) }}" method="POST">
                                            <a href="{{ route('gallery.edit', ['gallery' => $gallery['id']]) }}"  class="btn btn-outline-primary mt-2 ms-4 mb-2">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger mt-2 mb-2">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-sm-12 text-center">
                                <h3>Data Not Found.</h3>
                            </div>
                        @endif
                    </div>
                    <div class="d-flex">
                        {{ $items->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
            <div class="text-end">
                <a href="{{ route('gallery.create') }}"  class="btn btn-outline-primary mt-2 ">Add</a>
                @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
            </div>
        </div>
    </div>
@endsection
