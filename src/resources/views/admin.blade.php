@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<style>
    /* 1. テーブル全体の基本設定 */
    .admin__table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        table-layout: fixed;
        /* 幅を固定して安定させる */
    }

    .admin-table__header,
    .admin__data {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* 2. 各列の幅（お好みで調整してください） */
    .admin-table__header:nth-child(1) {
        width: 15%;
    }

    /* お名前 */
    .admin-table__header:nth-child(2) {
        width: 10%;
    }

    /* 性別 */
    .admin-table__header:nth-child(3) {
        width: 25%;
    }

    /* メール */
    .admin-table__header:nth-child(4) {
        width: 30%;
    }

    /* 種類 */
    .admin-table__header:nth-child(5) {
        width: 20%;
    }

    /* ボタン */

    /* 3. 詳細ボタンの見た目 */
    .admin__detail-btn {
        display: inline-block;
        padding: 5px 15px;
        background-color: #fff;
        border: 1px solid #e0dfde;
        color: #8b7969;
        text-decoration: none;
        font-size: 14px;
        border-radius: 2px;
    }

    .admin__detail-btn:hover {
        background-color: #f8f8f8;
    }

    /* 4. 【重要】モーダルを隠し、画面中央に浮かせる設定 */
    .modal-overlay {
        display: none;
        /* 普段は絶対に隠す */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    /* 5. 詳細ボタンが押された時（URLが#modal-IDになった時）だけ表示 */
    .modal-overlay:target {
        display: flex;
    }

    /* 6. モーダルの白い窓 */
    .modal-window {
        background: #fff;
        width: 600px;
        max-width: 90%;
        padding: 40px;
        position: relative;
        border-radius: 4px;
        white-space: normal;
        /* テーブルの改行禁止を解除 */
    }

    .modal-close {
        position: absolute;
        top: 10px;
        right: 20px;
        text-decoration: none;
        color: #8b7969;
        font-size: 30px;
    }

    /* 7. モーダル内のテーブル */
    .modal-table {
        width: 100%;
        margin-top: 20px;
    }

    .modal-table th {
        text-align: left;
        width: 35%;
        padding: 10px 0;
    }

    /* 8. 削除ボタン */
    .delete-btn {
        display: block;
        margin: 30px auto 0;
        background-color: #f44336;
        color: #fff;
        border: none;
        padding: 10px 40px;
        cursor: pointer;
        border-radius: 2px;
    }

    /* ヘッダー全体を整列させる */
    .header__inner {
        display: flex;
        justify-content: center;
        /* タイトルを中央に */
        align-items: center;
        position: relative;
        /* ログアウトボタンを右端に固定するための基準 */
        width: 100%;
        padding: 20px 0;
    }

    /* タイトルロゴ */
    .header__logo {
        margin: 0 auto;
        text-align: center;
    }

    /* ログアウトボタンを右端へ強制移動 */
    .header-nav {
        position: absolute;
        right: 50px;
    }

    .header-nav__button {
        background: none;
        border: none;
        color: #8b7969;
        cursor: pointer;
        text-transform: lowercase;
        /* デザインに合わせて小文字に */
    }

    .header__inner {
        position: relative;
        /* 基準点にする */
        display: flex;
        justify-content: center;
    }

    .header-nav {
        position: absolute;
        right: 50px;
        /* 右端から50pxの位置に固定 */
    }

    /* ログアウトボタン自体のデザイン */
    .header-nav__button {
        background-color: #8b7969;
        /* 背景をロゴと同じ茶色にして重厚感を出す */
        color: #fff;
        /* 文字を白抜きにしてくっきりさせる */
        border: none;
        /* 枠線はなしでスッキリ */
        padding: 10px 25px;
        /* 上下10px、左右25pxに広げてサイズアップ */
        cursor: pointer;
        font-size: 16px;
        /* 文字サイズを16pxに大きく */
        font-weight: bold;
        /* 太字にして存在感を出す */
        border-radius: 4px;
        /* 角を少し丸める */
        transition: background-color 0.3s;
        line-height: 1;
        /* 文字を中央に安定させる */
    }

    /* マウスを乗せた時に少し色を変える（反応を良くする） */
    .header-nav__button:hover {
        background-color: #a29182;
        /* 少しだけ明るい茶色に */
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
                {{-- ボタンのリンク先をモーダルのIDにする --}}
                <a class="admin__detail-btn" href="#modal-{{ $contact->id }}">詳細</a>

                {{-- モーダル本体をここに隠しておく --}}
                <div id="modal-{{ $contact->id }}" class="modal-overlay">
                    <div class="modal-window">
                        <a href="#" class="modal-close">×</a>
                        <div class="modal-inner">
                            <table class="modal-table">
                                <tr>
                                    <th>お名前</th>
                                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                                </tr>
                                <tr>
                                    <th>性別</th>
                                    <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
                                </tr>
                                <tr>
                                    <th>メールアドレス</th>
                                    <td>{{ $contact->email }}</td>
                                </tr>
                                <tr>
                                    <th>電話番号</th>
                                    <td>{{ $contact->tel }}</td>
                                </tr>
                                <tr>
                                    <th>住所</th>
                                    <td>{{ $contact->address }}</td>
                                </tr>
                                <tr>
                                    <th>建物名</th>
                                    <td>{{ $contact->building }}</td>
                                </tr>
                                <tr>
                                    <th>お問い合わせの種類</th>
                                    <td>{{ $contact->category->content }}</td>
                                </tr>
                                <tr>
                                    <th>お問い合わせ内容</th>
                                    <td>{{ $contact->detail }}</td>
                                </tr>
                            </table>

                            {{-- 削除機能 (FN026) --}}
                            <form action="/admin/delete/{{ $contact->id }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('本当に削除しますか？')">削除</button>
                            </form>
                        </div>
                    </div>
                </div>
            </td> {{-- ここで詳細ボタンの列は終了 --}}
        </tr> {{-- ここで行が終了 --}}
        @endforeach
    </table>

</div> {{-- ← ★重要！admin__contentを閉じる。これが無いとタイトルが左下に行きます --}}
@endsection