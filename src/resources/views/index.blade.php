<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">Contact Form</a>
        </div>
    </header>

    <main>
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2>お問い合わせ</h2>
            </div>

            <form class="form" action="{{ route('confirm') }}" method="post">
                @csrf

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お名前</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="first_name" placeholder="例: 山田" value="{{ old('first_name') }}" />
                            <input type="text" name="last_name" placeholder="例: 太郎" value="{{ old('last_name') }}" />
                        </div>
                        <div class="form__error">
                            @error('first_name') <p>{{ $message }}</p> @enderror
                            @error('last_name') <p>{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">性別</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--radio">
                            <label><input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}>男性</label>
                            <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>女性</label>
                            <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>その他</label>
                        </div>
                        @error('gender') <p class="form__error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">メールアドレス</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" />
                        </div>
                        @error('email') <p class="form__error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">電話番号</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1') }}" /> -
                            <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}" /> -
                            <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}" />
                        </div>
                        <div class="form__error">
                            @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                            <strong>電話番号を入力してください</strong>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">住所</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="address" placeholder="例: 東京都渋谷区..." value="{{ old('address') }}" />
                        </div>
                        @error('address') <p class="form__error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせの種類</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <select name="category_id">
                            <option value="">選択してください</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="form__error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせ内容</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--textarea">
                            <textarea name="detail" placeholder="資料をいただきたいです">{{ old('detail') }}</textarea>
                        </div>
                        @error('detail') <p class="form__error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form__button">
                    <button class="form__button-submit" type="submit">送信</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>