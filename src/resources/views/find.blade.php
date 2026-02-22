@extends('layouts.app')

@section('title', 'find.blade.php')

@section('content')
{{-- style は section の中に入れるか、別の場所に移動します --}}
<style>
    th {
        background-color: #289ADC;
        color: white;
        padding: 5px 40px;
    }

    td {
        padding: 25px 40px;
        background-color: #EEEEEE;
        text-align: center;
    }
</style>

<div class="container"> {{-- 全体を囲うと崩れにくくなります --}}
    <form action="/find" method="POST">
        @csrf
        <input type="text" name="input" value="{{$input}}">
        <input type="submit" value="見つける">
    </form>

    @if (isset($item) && $item)
    <p>検索結果が見つかりました：</p>
    <table>
        <tr>
            <th>ID</th>
            <th>お名前</th>
        </tr>
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->first_name}} {{$item->last_name}}</td>
        </tr>
    </table>
    @elseif(isset($item))
    <p>データが見つかりませんでした。</p>
    @endif
</div>
@endsection