@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

@if(session('success'))
<div class="todo__alert">
  <div class="todo__alert--success">
    {{ session('success') }}
  </div>
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

<div class="todo__content">

  {{-- 作成フォーム --}}
  <form action="/todos" method="POST" class="create-form">
    @csrf
    <div class="create-form__item">
      <input class="create-form__item-input" type="text" name="content">
    </div>
    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">作成</button>
    </div>
  </form>

  {{-- 一覧 --}}
  <div class="todo-table">
    <table class="todo-table__inner">
      <tr class="todo-table__row">
        <th class="todo-table__header">Todo</th>
      </tr>

      @foreach($todos as $todo)
      <tr class="todo-table__row">
        <td class="todo-table__item">

          {{-- 更新 --}}
          <form action="/todos/update" method="POST" class="update-form">
            @csrf
            @method('PATCH')

            <input type="hidden" name="id" value="{{ $todo->id }}">

            <div class="update-form__item">
              <input class="update-form__item-input"
                     type="text"
                     name="content"
                     value="{{ $todo->content }}">
            </div>

            <div class="update-form__button">
              <button class="update-form__button-submit" type="submit">更新</button>
            </div>
          </form>

        </td>

        <td class="todo-table__item">
         <form action="/todos/delete" method="POST" class="delete-form">
            @csrf
            @method('DELETE')

            <input type="hidden" name="id" value="{{ $todo->id }}">

            <button class="delete-form__button-submit" type="submit">削除</button>
          </form>

        </td>
      </tr>
      @endforeach

    </table>
  </div>

</div>

@endsection