@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form_wrapper">
        <div class="form_container">
            <div class="title_container">
                <h2>Registrar usuario</h2>
            </div>
            <div class="row clearfix justify-content-center">
                <form method="POST" action="{{ route('register') }}" onsubmit="localStorage.clear();">
                    @csrf
                    <div class="input_field">
                        <span><svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-envelope mt-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                            </svg>
                        </span>
                        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Ingrese su email">
                        @error('email')
                        <p class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                    <div class="input_field"> <span><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-fill mt-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg></span>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Ingrese su nombre de usuario">
                        @error('name')
                        <p class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                    <div class="input_field"> <span><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-lock mt-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1zm-7-1a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-7zm0-3a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z" />
                            </svg></span>
                        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Ingrese su password">
                        @error('password')
                        <p class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                    <div class="input_field"> <span><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-lock mt-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1zm-7-1a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-7zm0-3a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z" />
                            </svg></span>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Repetir password">
                        @error('password')
                        <p class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                    <label for="type-user"><strong>Seleccione un tipo de usuario</label></strong>
                    <div class="input_field select_option">
                        <select name="type-user" id="usertype">
                            @foreach ($roles as $rol)
                            <option value={{$rol->id}}>{{$rol->name_role}}</option>
                            @endforeach
                        </select>
                        <div class="select_arrow"></div>
                    </div>
                    <input class="button" type="submit" value="Register" />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection