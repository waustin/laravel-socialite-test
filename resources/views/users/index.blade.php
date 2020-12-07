@extends('layouts.app')

@section('content')
<div class="container">
        @forelse($users as $user)
            <div class="mb-4">
                @if($user->profile_pic)
                    <img src="{{$user->profile_pic_url}}" class="mb-2" style="max-width: 200px;" alt="Profile Pic"/><br>
                @endif
                <h5>{{$user->name}} - {{$user->email}}</h5>
                <a class="btn btn-link" href="{{ route('users.show', $user) }}">View Profile</a>
            </div>
        @empty
            <div>
                <p>No Users</p>
            </div>
        @endforelse
</div>
@endsection