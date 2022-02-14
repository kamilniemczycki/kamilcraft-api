@extends('layout.app')
@section('title', 'Login')

@section('main')
<form class="form" method="POST" action="">
    @csrf
    <label for="email">E-mail</label>
    <input id="email" type="text" name="email" value="{{ old('email') }}" placeholder="Podaj swój e-mail">
    @error('email')
    <span class="error">{{ $message }}</span>
    @enderror
    <label for="email">Hasło</label>
    <input id="email" type="password" name="password" placeholder="Podaj swoje hasło">
    <input type="submit" value="Zaloguj">
</form>
@endsection
