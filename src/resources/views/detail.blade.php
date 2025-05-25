@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('content')
    <div class="product__content">
        <div class="product__content-title">
            <a href="/products">商品一覧</a>
            <span>>{{$product->name}}</span>
        </div>
        <form class="product__form" action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data">
            @csrf
            <div class="product__item">
                <div class="product__item-image">
                    <img src="/storage/images/{{ $product->image }}">
                    <div class="product__item-input">
                        <label class="product__item-file" for="file_photo">
                            <input type="file" name="image" id="file_photo" accept=".jpg, .jpeg, .png"/>
                            ファイルを選択
                        </label>
                        <span>{{$product->image}}</span>
                        <div class="detail__form__error-message">
                            @error('image')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="product__detail">
                    <div class="product__name">
                        <div class="product__item-label">
                            商品名
                        </div>
                        <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name' , $product->name) }}">
                        <div class="detail__form__error-message">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="product__price">
                        <div class="product__item-label">
                            値段
                        </div>
                        <input type="number" name="price" placeholder="値段を入力" value="{{ old('price' , $product->price) }}">
                        <div class="detail__form__error-message">
                            @error('price')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="product__season">
                        <div  class="product__item-label">
                            季節
                        </div>
                        <fieldset class="product__season-item">
                            @foreach ($seasons as $season)
                            <label class="product__season-item-label">
                                <input type="checkbox" name="seasons[]" value="{{ $season->id }}" {{ $product->seasons->contains('id', $season->id) ? 'checked' : ''}}>
                                <span></span>
                                    {{ $season->name }}
                            </label>
                            @endforeach
                        </fieldset>
                        <div class="detail__form__error-message">
                            @error('seasons')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="product__textarea">
                <div class="product__item-label">
                    商品説明
                </div>
                <div class="product__textarea">
                    <textarea name="description" placeholder="商品の説明を記入">{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="detail__form__error-message">
                    @error('description')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="product__button-block">
                <div class="product__button-inner">
                    <a href="/products" class="product__button-back">戻る</a>
                    <input class="product__button-save" type="submit" value="変更を保存" name="update">
                    <input type="hidden" name="id" value="{{ $product->id }}">
                </div>
            </div>
        </form>
        @if (!$errors->any())
        <form class="product-delete__form" action="/products/{{ $product->id }}/delete" method="post" >
            @csrf
            <input class="product__button-delete" type="submit" value="削除" name="delete">
            <input type="hidden" name="id" value="{{ $product->id }}">
        </form>
        @endif
    </div>
@endsection