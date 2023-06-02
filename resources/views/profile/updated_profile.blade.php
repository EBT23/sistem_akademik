@extends('profile.base_profile',['title' => "$title"])
@section('content')
<div class="container-fluid py-4">
<div class="row">
<div class="col-5">
    <div class="card mb-2">
        <div class="card-header pb-0">
          <h6 class="text-center">Edit Profile</h6>
        </div>
        <div class="card-body">
          <form action="{{ route('update.profile') }}" method="POST">
            @csrf
          <div class="row">
            <div class="col-lg">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="full_name" id="full_name" class="form-control" value="{{ auth()->user()->full_name }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            <div class="sidenav-footer">
              <br>
              <button type="submit" class="btn bg-gradient-info btn mb-0 w-100">Simpan</button>
          </div>
          </div>
        </form>
        </div>
      </div>
</div>
</div>
</div>
@endsection