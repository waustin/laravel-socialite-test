@extends('layouts.app')

@section('content')
<div class="container">
    @if($can_edit)
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('users.update', [$user])}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input  class="form-control @error('name') is-invalid @enderror" 
                                type="text"
                                id="name" name="name" value="{{ old('name', $user->name) }}" />
                        
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        @if($user->profile_pic)
                            <div class="mb-2">
                            <label>Current Profile Pic</label><br>
                            <img src="{{$user->profile_pic_url}}" alt="Profile Pic" style="max-width: 200px;" />
                            </div>
                        @endif
                        <label for="profile_pic">Change Pic</label>
                        <input class="form-control-file @error('profile_pic') is-invalid @enderror" 
                                type="file" name="profile_pic"  id="profile_pic"/>
                        @error('profle_pic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    @else 
        <p>Not your profile. {{$user->email}}, {{$user->name}}, {{$user->id}}</p>
    @endif
</div>
@endsection