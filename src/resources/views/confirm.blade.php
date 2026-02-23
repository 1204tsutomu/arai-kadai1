<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Confirm</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">Fashionably Late</a>
        </div>
    </header>

    <main>
        <div class="confirm__content">
            <div class="confirm__heading">
                <h2>Confirm</h2>
            </div>

            <form class="form" action="{{ route('store') }}" method="post">
                @csrf
                <div class="confirm-table">
                    <table class="confirm-table__inner">
                        {{-- お名前 --}}
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お名前</th>
                            <td class="confirm-table__text">
                                <span>{{ $contact['last_name'] }} {{ $contact['first_name'] }}</span>
                                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" />
                                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" />
                            </td>
                        </tr>
                        {{-- 性別 --}}
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">性別</th>
                            <td class="confirm-table__text">
                                <span>{{ $contact['gender'] == '1' ? '男性' : ($contact['gender'] == '2' ? '女性' : 'その他') }}</span>
                                <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />
                            </td>
                        </tr>
                        {{-- メール --}}
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">メールアドレス</th>
                            <td class="confirm-table__text">
                                <span>{{ $contact['email'] }}</span>
                                <input type="hidden" name="email" value="{{ $contact['email'] }}" />
                            </td>
                        </tr>
                        {{-- 電話 --}}
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">電話番号</th>
                            <td class="confirm-table__text">
                                <span>{{ $contact['tel'] }}</span>
                                <input type="hidden" name="tel" value="{{ $contact['tel'] }}" />
                            </td>
                        </tr>
                        {{-- 住所 --}}
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">住所</th>
                            <td class="confirm-table__text">
                                <span>{{ $contact['address'] }}</span>
                                <input type="hidden" name="address" value="{{ $contact['address'] }}" />
                            </td>
                        </tr>
                        {{-- 建物名 --}}
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">建物名</th>
                            <td class="confirm-table__text">
                                <span>{{ $contact['building_name'] }}</span>
                                <input type="hidden" name="building_name" value="{{ $contact['building_name'] }}" />
                            </td>
                        </tr>
                        {{-- 種類 --}}
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせの種類</th>
                            <td class="confirm-table__text">
                                <span>{{ $contact['category_content'] }}</span>
                                <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" />
                            </td>
                        </tr>
                        {{-- 内容 --}}
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせ内容</th>
                            <td class="confirm-table__text">
                                <span>{{ $contact['detail'] }}</span>
                                <input type="hidden" name="detail" value="{{ $contact['detail'] }}" />
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">送信</button>
                    <a class="form__button-back" href="/">修正</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>