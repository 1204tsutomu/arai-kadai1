@extends('layouts.app')
<style>
    th {
        background-color: #289ADC;
        color: white;
        padding: 5px 40px;
    }

    tr:nth-child(odd) td {
        background-color: #FFFFFF;
    }

    td {
        padding: 25px 40px;
        background-color: #EEEEEE;
        text-align: center;
    }
</style>
@section('title', 'binds.blade.php')

@section('content')
<p>Contact Detail</p>
<table>
    <tr>
        <th>ID</th>
        <th>お名前</th>
        <th>性別</th>
        <th>メールアドレス</th>
        <th>お問い合わせの種類</th>
    </tr>
    <tr>
        <td> {{$item->id}} </td>
        <td> {{$item->fullname}} </td>
        <td>
            {{ $item->gender == 1 ? '男性' : ($item->gender == 2 ? '女性' : 'その他') }}
        </td>
        <td> {{$item->email}} </td>
        <td> {{$item->category_id}} </td>
    </tr>
</table>
@endsection