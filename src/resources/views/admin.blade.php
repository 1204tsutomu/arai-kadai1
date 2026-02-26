@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<style>
    /* テーブルの各列の幅を、現在の順番に合わせて再定義 */
    .admin__table th:nth-child(1),
    .admin__table td:nth-child(1) {
        width: 10%;
    }

    /* 詳細 */
    .admin__table th:nth-child(2),
    .admin__table td:nth-child(2) {
        width: 20%;
    }

    /* お名前 */
    .admin__table th:nth-child(3),
    .admin__table td:nth-child(3) {
        width: 10%;
    }

    /* 性別 */
    .admin__table th:nth-child(4),
    .admin__table td:nth-child(4) {
        width: 30%;
    }

    /* メールアドレス */
    .admin__table th:nth-child(5),
    .admin__table td:nth-child(5) {
        width: 30%;
    }

    /* お問い合わせの種類 */

    /* テキストが重ならないように調整 */
    .admin__table th,
    .admin__table td {
        text-align: left;
        padding: 15px 10px;
        white-space: nowrap;
        /* 改行を防ぐ */
    }

    /* 「詳細」ボタンのスタイルを整える */
    .admin__detail-btn {
        background: #f4f4f4;
        border: 1px solid #ccc;
        padding: 5px 10px;
        text-decoration: none;
        color: #8b7969;
        /* 元のデザインに近い色 */
        border-radius: 2px;
    }

    /* テーブルの横幅を固定せず、コンテンツに合わせるか均等にする */
    .admin__table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        table-layout: auto;
        /* コンテンツ量に合わせて自動調整 */
    }

    .admin__label,
    .admin__data {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
        /* 見本に近い区切り線 */
    }

    /* 詳細ボタンを見本のスタイル（薄い枠線）に寄せる */
    .admin__detail-btn {
        display: inline-block;
        padding: 5px 15px;
        background-color: #fff;
        border: 1px solid #e0dfde;
        color: #8b7969;
        text-decoration: none;
        font-size: 14px;
    }

    .admin__detail-btn:hover {
        background-color: #f8f8f8;
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
        {{-- 指摘２：重複を削除し、検索条件を維持するコードのみ残す --}}
        <div class="pagination">
            {{ $contacts->appends(request()->query())->links() }}
        </div>
    </div>

    <table class="admin-table"> {{-- admin__table から admin-table へ修正 --}}
        <tr class="admin-table__row">
            <th class="admin-table__header">お名前</th>
            <th class="admin-table__header">性別</th>
            <th class="admin-table__header">メールアドレス</th>
            <th class="admin-table__header">お問い合わせの種類</th>
            <th class="admin-table__header"></th>
        </tr>

        @foreach ($contacts as $contact)
        <tr class="admin__row">
            <td class="admin__data">
                {{ $contact->last_name }}　{{ $contact->first_name }}
            </td>
            <td class="admin__data">
                {{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}
            </td>
            <td class="admin__data">
                {{ $contact->email }}
            </td>
            <td class="admin__data">
                {{ $contact->category->content }}
            </td>

            <td class="admin-table__item">
                <a class="detail-btn" href="#">詳細</a> {{-- admin__detail-btn から detail-btn へ修正 --}}
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection