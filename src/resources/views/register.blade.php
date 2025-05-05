@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('content')
    <div class="register__content">
        <div class="register__heading">
            <h2>商品登録</h2>
        </div>
        <form class="register-form" action="/register" method="post">
            @csrf
            <div class="register-form__item">
                <div class="register-form__title">
                    <span>商品名</span>
                    <span>必須</span>
                </div>
                <div class="register-form__item-input">
                    <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}"/>
                    <div class="error">
                    @error('name')
                            {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>
            <div class="register-form__item">
                <div class="register-form__title">
                    <span>値段</span>
                    <span>必須</span>
                </div>
                <div class="register-form__item-input">
                    <input type="number" name="value" placeholder="値段を入力" value="{{ old('value') }}"/>
                    <div class="error">
                    @error('value')
                            {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>
            <div class="register-form__item">
                <div class="register-form__title">
                    <span>商品画像</span>
                    <span>必須</span>
                </div>
                <div class="register-form__item-input">
                    <input type="file" name="file" placeholder="ファイルを選択" value="{{ old('file') }}"/>
                    <div class="error">
                    @error('file')
                            {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>
            <div class="register-form__item">
                <div class="register-form__title">
                    <span>季節</span>
                    <span>必須</span>
                    <span>複数選択可</span>
                </div>
                <fieldset class="register-form__item-season">
                    <label class="register-form__item-season-label">
                        <input type="checkbox" name="seasons" value="spring">
                            春
                    </label>
                    <label class="register-form__item-season-label">
                        <input type="checkbox" name="seasons" value="summer">
                            夏
                    </label>
                    <label class="register-form__item-season-label">
                        <input type="checkbox" name="seasons" value="autumn">
                            秋
                    </label>
                    <label class="register-form__item-season-label">
                        <input type="checkbox" name="seasons" value="winter">
                            冬
                    </label>
                </fieldset>
            </div>
            <div class="register-form__item">
                <div class="register-form__title">
                    <span>商品説明</span>
                    <span>必須</span>
                </div>
                <div class="register-form__item-input">
                    <textarea name="detail" placeholder="商品の説明を入力">
                    </textarea>
                    <div class="error">
                    @error('value')
                            {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>
            <div class="register-form__button">
                <div>
                    <a href="/products">戻る</a>
                </div>
                <button class="register-form__button-submit" type="submit">登録</button>
            </div>
        </form>
    </div>
@endsection