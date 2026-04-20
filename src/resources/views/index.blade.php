@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="todo__alert">
  @if (session('message'))
    <div class="todo__alert--success">
      {{ session('message') }}
    </div>
  @endif

  @if ($errors->any())
    <div class="todo__alert--danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
</div>

<div class="todo__content">

  {{-- ================= 新規作成 ================= --}}
  <div class="section__title">
    <h2>新規作成</h2>
  </div>

  <form class="create-form" action="/todos" method="POST">
    @csrf
    <div class="create-form__item">

      <input
        class="create-form__item-input"
        type="text"
        name="content"
        value="{{ old('content') }}"
      />

      <select class="create-form__item-select" name="category_id">
        <option value="">カテゴリ</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}">
            {{ $category->name }}
          </option>
        @endforeach
      </select>

    </div>

    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">作成</button>
    </div>
  </form>

  {{-- ================= 検索 ================= --}}
  <div class="section__title">
    <h2>Todo検索</h2>
  </div>

  <form class="search-form" action="/" method="GET">
    <div class="search-form__item">

      <input
        class="search-form__item-input"
        type="text"
        name="keyword"
        value="{{ request('keyword') }}"
        placeholder="キーワード検索"
      >

      <select class="search-form__item-select" name="category_id">
        <option value="">カテゴリ</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}"
            {{ request('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>

    </div>

    <div class="search-form__button">
      <button class="search-form__button-submit" type="submit">検索</button>
    </div>
  </form>

  {{-- ================= 一覧 ================= --}}
  <div class="todo-table">
    <table class="todo-table__inner">

      <tr>
        <th>Todo</th>
        <th>カテゴリ</th>
        <th></th>
      </tr>

      @foreach ($todos as $todo)
      <tr>

        {{-- Todo更新 --}}
        <td>
          <form action="/todos/update" method="POST">
            @csrf
            @method('PATCH')

            <input type="hidden" name="id" value="{{ $todo->id }}">

            <input
              type="text"
              name="content"
              value="{{ $todo->content }}"
            >
        </td>

        {{-- カテゴリ変更できる --}}
        <td>
          <select name="category_id">
    @foreach ($categories as $category)
      <option value="{{ $category->id }}"
        {{ $todo->category_id == $category->id ? 'selected' : '' }}>
        {{ $category->name }}
      </option>
    @endforeach
  </select>

        </td>

        {{-- ボタン --}}
        <td>
            <button type="submit">更新</button>
          </form>

          <form action="/todos/delete" method="POST">
            @csrf
            @method('DELETE')

            <input type="hidden" name="id" value="{{ $todo->id }}">

            <button type="submit">削除</button>
          </form>
        </td>

      </tr>
      @endforeach

    </table>
  </div>

</div>

@endsection