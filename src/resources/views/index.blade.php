@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="/contacts/confirm" method="post">
    @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">＊</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="first_name" placeholder="姓  山田" value="{{ old('first_name') }}">
                    <input type="text" name="last_name" placeholder="名  一郎" value="{{ old('last_name') }}">
                </div>
                <div class="form__error">
                    @error('first_name')
                        <p>{{ $message }}</p>
                    @enderror
                    @error('last_name')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">＊</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    <input type="radio" name="gender" value="男性" id="male" {{ old('gender') === '男性' ? 'checked' : '' }}>
                        <label for="male">男性</label>
                    <input type="radio" name="gender" value="女性" id="female" {{ old('gender') === '女性' ? 'checked' : '' }}>
                        <label for="female">女性</label>
                    <input type="radio" name="gender" value="その他" id="other" {{ old('gender') === 'その他' ? 'checked' : '' }}>
                        <label for="other">その他</label>
                </div>
                <div class="form__error">
                    @error('gender')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">＊</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="sample@example.com" value="{{ old('email') }}">
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
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">＊</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="tel" name="tel" placeholder="09012345678" value="{{ old('tel') }}">
                </div>
                <div class="form__error">
                    @error('tel')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">＊</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" placeholder="例）東京都新宿区○○町1-1" value="{{ old('address') }}">
                </div>
                <div class="form__error">
                    @error('address')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例）○○マンション101" value="{{ old('building') }}">
                </div>
                <div class="form__error">
                    @error('building')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">＊</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <select name="inquiry_type">
                        <option value="" disabled {{old('inquiry_type') ? '' : 'selected'}}>選択してください</option>
                        <option value="商品のお届けについて" {{ old('inquiry_type') == '商品のお届けについて' ? 'selected' : '' }}>商品のお届けについて</option>
                        <option value="商品の交換について" {{ old('inquiry_type') == '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
                        <option value="商品トラブル" {{ old('inquiry_type') == '商品トラブル' ? 'selected' : '' }}>商品トラブル</option>
                        <option value="ショップへのお問い合わせ" {{ old('inquiry_type') == 'ショップへのお問い合わせ' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                        <option value="その他" {{ old('inquiry_type') == 'その他' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
                <div class="form__error">
                    @error('inquiry_type')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">＊</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea class="form__textarea" name="detail" placeholder="お問い合わせ内容" required>{{ old('detail') }}</textarea>
                </div>
                <div class="form__error">
                    @error('detail')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection