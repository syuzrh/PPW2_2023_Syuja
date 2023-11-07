@extends('auth.layouts')

@section('content')
<div class="container mt-5">
    <h2 class="my-5">Dashboard</h2>
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        {{ $message }}
    </div>
    @endif
    <div class="table">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Thumbnail</th>
                    <th scope="col">Square</th>
                    <th scope="col">Original</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($user as $u)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$u->name}}</td>
                    <td>{{$u->email}}</td>
                    <td><img src="{{asset('storage/profile/' . $u->photo)}}" alt=""></td>
                    <td><img src="{{asset('storage/profile/thumbnail/square_' . $u->photo)}}" alt=""></td>
                    <td><a href="#" onclick="Swal.fire({
                        imageUrl: `{{asset('storage/profile/' . $u->photo)}}`,
                    
                        imageAlt: 'An image'
                      })">Preview</a></td>
                    <td>
                        <a href="/edit/{{$u->id}}"><button class="btn btn-warning ">Edit</button></a>
                    </td>
                </tr>
                <?php $i++
                ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
{{-- <img src="{{asset('storage/profile/' . $u->photo)}}" alt=""> --}}