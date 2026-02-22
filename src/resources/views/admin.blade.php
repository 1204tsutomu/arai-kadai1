@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<style>
    /* テーブル全体を最前面に引っ張り出す */
    .admin__content {
        position: relative;
        z-index: 1;
        margin-top: 20px;
    }

    .admin-table {
        position: relative;
        z-index: 10;
        width: 100%;
        border-collapse: collapse;
    }

    /* リンクを確実にクリック可能にする設定 */
    .detail-link {
        color: blue !important;
        text-decoration: underline !important;
        font-weight: bold;
        cursor: pointer !important;
        display: block;
        /* クリックエリアを広げる */
        padding: 10px;
    }
</style>
@endsection

@section('content')
<div class="admin__content">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>

    {{-- 検索フォーム --}}
    {{-- 検索フォーム部分をこれに差し替えてください --}}
    <form action="/authors" method="GET" class="search-form">
        {{-- 1 & 2. 名前・メールアドレス検索用 --}}
        <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

        {{-- 3. 性別選択 --}}
        <select name="gender">
            <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>性別</option>
            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
        </select>

        {{-- 4. お問い合わせの種類 --}}
        <select name="category_id">
            <option value="">お問い合わせの種類</option>
            {{-- ここは後でDBからループさせるのが綺麗ですが、まずは手書きで動作確認 --}}
            <option value="1" {{ request('category_id') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
            <option value="2" {{ request('category_id') == '2' ? 'selected' : '' }}>商品の交換について</option>
            <option value="3" {{ request('category_id') == '3' ? 'selected' : '' }}>商品トラブル</option>
            <option value="4" {{ request('category_id') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
            <option value="5" {{ request('category_id') == '5' ? 'selected' : '' }}>その他</option>
        </select>

        {{-- 5. 日付検索 (input type="date" を使用) --}}
        <input type="date" name="date" value="{{ request('date') }}">

        <button type="submit" class="search-btn">検索</button>

        {{-- リセットボタン --}}
        <a href="/authors" class="reset-btn" style="text-decoration: none; padding: 5px 10px; background: #eee; border: 1px solid #ccc; color: #333;">リセット</a>
    </form>

    <div class="admin-sub__nav">
        <button class="export-btn">エクスポート</button>
        <div class="pagination">
            {{ $contacts->links() }}
        </div>
        <div class="pagination">
            {{-- appends(request()->query()) を付けることで、検索条件を維持したままページ移動できます --}}
            {{ $contacts->appends(request()->query())->links() }}
        </div>
    </div>

    <table class="admin-table">
        <tr class="admin-table__row">
            {{-- 左端にリンクを配置 --}}
            <th class="admin-table__header">詳細</th>
            <th class="admin-table__header">お名前</th>
            <th class="admin-table__header">性別</th>
            <th class="admin-table__header">メールアドレス</th>
            <th class="admin-table__header">種類</th>
        </tr>
        @foreach ($contacts as $contact)
        <tr class="admin-table__row">
            {{-- 青い文字の直接リンク --}}
            <td class="admin-table__item">
                <a href="/author/{{ $contact->id }}" class="detail-link">
                    [表示]
                </a>
            </td>
            <td class="admin-table__item">{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td class="admin-table__item">
                @if($contact->gender == 1) 男性
                @elseif($contact->gender == 2) 女性
                @else その他 @endif
            </td>
            <td class="admin-table__item">{{ $contact->email }}</td>
            <td class="admin-table__item">{{ $contact->category->content ?? '不明' }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection