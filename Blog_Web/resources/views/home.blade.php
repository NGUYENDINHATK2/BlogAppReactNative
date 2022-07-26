@extends('layouts.app')

@section('content')
<div class="container">
        <form action="/posts" method="GET">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="">Konfirmasi Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>
@endsection
