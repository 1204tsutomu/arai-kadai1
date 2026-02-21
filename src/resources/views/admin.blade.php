@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin__content">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>

    {{-- 検索フォーム（外枠のみ再現） --}}
    <form class="search-form">
        <input type="text" placeholder="名前やメールアドレスを入力してください">
        <select>
            <option>性別</option>
        </select>
        <select>
            <option>お問い合わせの種類</option>
        </select>
        <input type="text" placeholder="年/月/日">
        <button type="submit" class="search-btn">検索</button>
        <button type="reset" class="reset-btn">リセット</button>
    </form>

    <div class="admin-sub__nav">
        <button class="export-btn">エクスポート</button>
        <div class="pagination">
            <nav>
                <div class="flex items-center">
                    {{-- 1. 「前へ」ボタン --}}
                    @if ($contacts->onFirstPage())
                    <span>&lsaquo;</span>
                    @else
                    <a href="{{ $contacts->previousPageUrl() }}" rel="prev">&lsaquo;</a>
                    @endif

                    {{-- 2. ページ番号（現在のページを中心に前後2つずつ表示して計5個） --}}
                    {{-- ※これで「矢印2個 + 数字5個 = 合計7個」になります --}}
                    @foreach ($contacts->getUrlRange(max(1, $contacts->currentPage() - 2), min($contacts->lastPage(), $contacts->currentPage() + 2)) as $page => $url)
                    @if ($page == $contacts->currentPage())
                    <span aria-current="page">{{ $page }}</span>
                    @else
                    <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                    @endforeach

                    {{-- 3. 「次へ」ボタン --}}
                    @if ($contacts->hasMorePages())
                    <a href="{{ $contacts->nextPageUrl() }}" rel="next">&rsaquo;</a>
                    @else
                    <span>&rsaquo;</span>
                    @endif
                </div>
            </nav>
        </div>
    </div>

    <table class="admin-table">
        <tr class="admin-table__row">
            <th class="admin-table__header">お名前</th>
            <th class="admin-table__header">性別</th>
            <th class="admin-table__header">メールアドレス</th>
            <th class="admin-table__header">お問い合わせの種類</th>
            <th class="admin-table__header"></th>
        </tr>
        @foreach ($contacts as $contact)
        <tr class="admin-table__row">
            <td class="admin-table__item">{{ $contact->last_name }}　{{ $contact->first_name }}</td>
            <td class="admin-table__item">
                @if($contact->gender == 1) 男性
                @elseif($contact->gender == 2) 女性
                @else その他 @endif
            </td>
            <td class="admin-table__item">{{ $contact->email }}</td>
            <td class="admin-table__item">{{ $contact->category->content }}</td>
            <td class="admin-table__item">
                <button class="detail-btn">詳細</button>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection