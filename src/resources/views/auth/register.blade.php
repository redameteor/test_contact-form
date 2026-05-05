@extends('layouts.authapp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-form__content">
    <div class="register-form__heading">
        <h2>Resister</h2>
    </div>
    <form class="form" action="/register" method="post">
    @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="name" placeholder="山田  一郎" value="{{ old('name') }}">
                </div>
                <div class="form__error">
                    @error('name')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="email" placeholder="sample@example.com" value="{{ old('email') }}">
                </div>
                <div class="form__error">
                    @error('email')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">パスワード</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="password" name="password" placeholder="sample123example" value="{{ old('password') }}">
                </div>
                <div class="form__error">
                    @error('password')
                        <p>{{ $message }}</p>
                    @enderror
                </div>    
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">パスワード確認用</span>
            </div>
            <div class="form__input--text">
                <input type="password" name="password_confirmation" placeholder="同じパスワードを入力">
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection