<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                Fashionably Late
            </a>
        </div>
    </header>

    <main>
        <div class="confirm__content">
            <div class="confirm__heading">
                <h2>confirm</h2>
            </div>
            <form class="form" action="{{ route('store') }}" method="post">
                @csrf
                <div class="confirm-table">
                    <table class="confirm-table__inner">
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お名前</th>
                            <td class="confirm-table__text">
                                <span>{{ $contact['first_name'] }}　{{ $contact['last_name'] }}</span>
                                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" />
                                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">性別</th>
                            <td class="confirm-table__text">
                                <span>{{ $contact['gender'] == '1' ? '男性' : ($contact['gender'] == '2' ? '女性' : 'その他') }}</span>
                                <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">メールアドレス</th>
                            <td class="confirm-table__text">
                                <span>{{ $contact['email'] }}</span>
                                <input type="hidden" name="email" value="{{ $contact['email'] }}" />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">電話番号</th>
                            <td class="confirm-table__text">
                                {{-- 表示用 --}}
                                <span>{{ $contact['tel'] }}</span>
                                {{-- 送信用（DBのtelカラムに入れる用） --}}
                                <input type="hidden" name="tel" value="{{ $contact['tel'] }}" />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">住所</th>
                            <td class="confirm-table__text">
                                <span>{{ $contact['address'] }}</span>
                                <input type="hidden" name="address" value="{{ $contact['address'] }}" />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">建物名</th>
                            <td class="confirm-table__text">
                                <span>{{ $contact['building'] }}</span>
                                <input type="hidden" name="building" value="{{ $contact['building'] }}" />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせの種類</th>
                            <td class="confirm-table__text">
                                <span>{{ $contact['category_content'] }}</span> {{-- ※注1 --}}
                                <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせ内容</th>
                            <td class="confirm-table__text">
                                <span>{{ $contact['detail'] }}</span>
                                <input type="hidden" name="detail" value="{{ $contact['detail'] }}" />
                            </td>
                        </tr>
                    </table>
                </div> {{-- confirm-tableの閉じ --}}

                <div class="form__button">
                    {{-- 送信ボタン --}}
                    <button class="form__button-submit" type="submit">送信</button>

                    {{-- 修正ボタン --}}
                    <a class="form__button-back" href="javascript:history.back();">修正</a>
                </div>
            </form> {{-- formをここで閉じる（重要！） --}}
        </div> {{-- confirm__contentの閉じ --}}
    </main>
</body>

</html>