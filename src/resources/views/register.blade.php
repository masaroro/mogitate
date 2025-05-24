@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('content')
    <div class="register__content">
        <div class="register__heading">
            <h2>商品登録</h2>
        </div>
        <form class="register__form" action="/products" method="post" enctype="multipart/form-data">
            @csrf
            <div class="register__item">
                <div class="register__item-label">
                    <span>商品名</span>
                    <span>必須</span>
                </div>
                <div class="register__item-input">
                    <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}"/>
                    <div class="register__form__error-message">
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
                    <input type="number" name="price" placeholder="値段を入力" value="{{ old('price') }}"/>
                    <div class="register__form__error-message">
                        @error('price')
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
                <div class="register__item-image">
                    <input class="register__item-file" type="file" name="image" placeholder="ファイルを選択" value=""/>
                    <div class="register__form__error-message">
                        @error('image')
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
                <div class="register__season-list">
                    <fieldset class="register__item-season">
                        @foreach ($seasons as $season)
                        <label class="register__item-season-label">
                            <input type="checkbox" name="seasons[]" value="{{ $season->id }}" {{ in_array($season->id, old('seasons', [])) ? 'checked' : '' }}>
                                {{ $season->name }}
                        </label>
                        @endforeach
                    </fieldset>
                    <div class="register__form__error-message">
                        @error('seasons')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="register__item">
                <div class="register__item-label">
                    <span>商品説明</span>
                    <span>必須</span>
                </div>
                <div class="register__item-input">
                    <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                    <div class="register__form__error-message">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                </div>
            </div>
            <div class="register__button">
                <a href="/products" class="register__button-back">戻る</a>
                <input class="register__button-save" type="submit" value="登録" name="register">
            </div>
        </form>
    </div>
@endsection