@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('content')
    <div class="register__content">
        <div class="register__heading">
            <h2>商品登録</h2>
        </div>
        <form class="register__form" action="/register" method="post">
            @csrf
            <div class="register__item">
                <div class="register__item-label">
                    <span>商品名</span>
                    <span>必須</span>
                </div>
                <div class="register__item-input">
                    <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}"/>
                    <div class="error">
                    @error('name')
                        {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>
            <div class="register__item">
                <div class="register__item-label">
                    <span>値段</span>
                    <span>必須</span>
                </div>
                <div class="register__item-input">
                    <input type="number" name="price" placeholder="値段を入力" value="{{ old('value') }}"/>
                    <div class="error">
                    @error('value')
                        {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>
            <div class="register__item">
                <div class="register__item-label">
                    <span>商品画像</span>
                    <span>必須</span>
                </div>
                <div class="register__item-input">
                    <input class="register__item-file" type="file" name="image" placeholder="ファイルを選択" value="{{ old('file') }}"/>
                    <div class="error">
                    @error('file')
                        {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>
            <div class="register__item">
                <div class="register__item-label">
                    <span>季節</span>
                    <span>必須</span>
                    <span>複数選択可</span>
                </div>
                <fieldset class="register__item-season">
                    <label class="register__item-season-label">
                        <input type="checkbox" name="seasons[]" value="spring">
                            春
                    </label>
                    <label class="register__item-season-label">
                        <input type="checkbox" name="seasons[]" value="summer">
                            夏
                    </label>
                    <label class="register__item-season-label">
                        <input type="checkbox" name="seasons[]" value="autumn">
                            秋
                    </label>
                    <label class="register__item-season-label">
                        <input type="checkbox" name="seasons[]" value="winter">
                            冬
                    </label>
                </fieldset>
            </div>
            <div class="register__item">
                <div class="register__item-label">
                    <span>商品説明</span>
                    <span>必須</span>
                </div>
                <div class="register__item-input">
                    <textarea name="description" placeholder="商品の説明を入力">
                    </textarea>
                    <div class="error">
                    @error('value')
                        {{ $message }}
                    @enderror
                    </div>
                </div>
            </div>
            <div class="register__button">
                <input class="register__button-back" type="submit" value="戻る" name="back">
                <input class="register__button-save" type="submit" value="登録" name="register">
            </div>
        </form>
    </div>
@endsection