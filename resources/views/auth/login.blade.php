@extends('layouts.app')

@section('content')
    <div style="display: grid; place-items: center; min-height: 100vh;">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h4 class="text-center mb-2 font-weight-bold">{{ config('app.name') }}</h4>
            <h6 class="text-center text-muted mb-4">Dashboard</h6>

            <x-input name="email" type="email"></x-input>
            <x-input name="password" type="password"></x-input>
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Recordarme</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
        </form>
    </div>
@endsection
