@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Dashboard / Home</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>
                        Password Proteted page for: <strong>{{ Auth::user()->email}}</strong>
                    </p>
                    <code class="debug">
                        {{Auth::user()}}
                    </code>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
