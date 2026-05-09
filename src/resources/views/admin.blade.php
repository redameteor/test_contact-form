@extends('layouts.authapp')

@section('css')
 <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin__content">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>
    <form class="form" action="/admin" method="get">
        @csrf
        <div class="form__item">
            <input class="form__item-input" type="text" name="keyword" placeholder="名前かメールアドレスを入力して下さい" value="">
            <select class="form__item-select" name="gender">
                <option value="all" {{request('gender') == 'all' ? 'selected' : '' }}>性別</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : ''}}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : ''}}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : ''}}>その他</option>
            </select>
            <select class="form__item-select" name="category_id">
                <option value="">お問い合わせ種類</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
            <input class="form__item-date" type="date" name="date" value="{{ request('date') }}">
            <button class="form__item-btn" type="submit">検索</button>
            <a class="form__item-reset" href="/admin">リセット</a>
        </div>
    </form>
    <div class="admin-table__controls">
        <div class="admin-table__export">
            <form action="/admin/export" method="get">
                @foreach(request()->query() as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <button type="submit" class="export-btn">エクスポート</button>
            </form>
        </div>        
        <div class="admin-table__pagination">
            {{ $contacts->appends(request()->query())->links() }}
        </div>
    </div>
    <table class="admin-table">
        <tr class="admin-table__row">
            <th class="admin-table__label">お名前</th>
            <th class="admin-table__label">性別</th>
            <th class="admin-table__label">メールアドレス</th>
            <th class="admin-table__label">お問い合わせの種類</th>
            <th class="admin-table__label">{{-- 詳細ボタン用 --}}</th>
        </tr>
        @foreach($contacts as $contact)
        <tr class="admin-table__row">
            <td class="admin-table__item">
                {{ $contact->first_name }}&nbsp;{{ $contact->last_name }}
            </td>
            <td class="admin-table__item">
                @if($contact->gender == 1) 男性
                @elseif($contact->gender == 2) 女性
                @else その他
                @endif
            </td>
            <td class="admin-table__item">
                {{ $contact->email }}
            </td>
            <td class="admin-table__item">
                {{ $contact->category->content }}
            </td>
            <td class="admin-table__item">
                <a class="admin-table__detail-btn" href="#modal-{{ $contact->id }}">詳細</a>
            </td>
        </tr>
        @endforeach
    </table>
    @foreach($contacts as $contact)
    <div class="modal" id="modal-{{ $contact->id }}">
        <a href="#!" class="modal-overlay"></a>
        <div class="modal__content">
            <a href="#!" class="modal__close">×</a>
            <div class="modal__inner">
                <table class="modal-table">
                    <tr><th>お名前</th><td>{{ $contact->first_name }} {{ $contact->last_name }}</td></tr>
                    <tr><th>性別</th><td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td></tr>
                    <tr><th>メール</th><td>{{ $contact->email }}</td></tr>
                    <tr><th>電話番号</th><td>{{ $contact->tel }}</td></tr>
                    <tr><th>住所</th><td>{{ $contact->address }}</td></tr>
                    <tr><th>建物名</th><td>{{ $contact->building }}</td></tr>
                    <tr><th>お問い合わせ種類</th><td>{{ $contact->category->content }}</td></tr>
                    <tr><th>お問い合わせ内容</th><td>{{ $contact->detail }}</td></tr>
                </table>
                <form action="/admin/delete" method="post" class="delete-form">
                @csrf
                    <input type="hidden" name="id" value="{{ $contact->id }}">
                    <button type="submit" class="delete-btn">削除</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection