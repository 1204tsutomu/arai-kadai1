@extends('layouts.app') {{-- レイアウトは共通のものを使用 --}}

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<style>
  /* 教材にあった矢印サイズ調整用CSS */
  svg.w-5.h-5 {
    width: 30px;
    height: 30px;
  }

  /* テーブルの簡易スタイル */
  .admin-table {
    width: 100%;
    border-collapse: collapse;
  }

  .admin-table th {
    background-color: #8b7969;
    /* スクショの色に近い茶系 */
    color: white;
    padding: 10px;
  }

  .admin-table td {
    padding: 15px;
    border-bottom: 1px solid #eee;
    text-align: center;
  }
</style>
@endsection

@section('content')
<div class="admin__content">
  <div class="admin__heading">
    <h2>Admin</h2>
  </div>

  {{-- 検索フォームなどはここに配置 --}}

  <table class="admin-table">
    <tr>
      <th>お名前</th>
      <th>性別</th>
      <th>メールアドレス</th>
      <th>お問い合わせの種類</th>
      <th></th>
    </tr>
    @foreach ($contacts as $contact)
    <tr>
      <td>{{ $contact->first_name }}　{{ $contact->last_name }}</td>
      <td>
        @if($contact->gender == 1) 男性
        @elseif($contact->gender == 2) 女性
        @else その他 @endif
      </td>
      <td>{{ $contact->email }}</td>
      <td>{{ $contact->category->content ?? '' }}</td>
      <td>
        <button class="detail-button">詳細</button>
      </td>
    </tr>
    @endforeach
  </table>

  {{-- ページネーションリンク --}}
  <div class="pagination">
    {{ $contacts->links() }}
  </div>
</div>
@endsection