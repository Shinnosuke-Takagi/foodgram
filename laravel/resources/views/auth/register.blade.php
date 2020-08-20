@extends('app')

@section('title', 'ユーザー登録')

@section('content')
  <div class="container">
    <!-- Material form subscription -->
    <div class="card mt-3">

        <h5 class="card-header peach-gradient white-text text-center py-4">
            <strong>ユーザー登録</strong>
        </h5>

        @include('error_card_list')

        <!--Card content-->
        <div class="card-body px-lg-5">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" method="POST" action="{{ route('register') }}">
              @csrf

                <!-- Name -->
                <div class="md-form mt-3">
                    <input type="text" id="name" name="name" class="form-control" required value="{{ old('name') }}">
                    <label for="name">ユーザー名</label>
                </div>

                <!-- E-mai -->
                <div class="md-form">
                    <input type="email" id="email" name="email" class="form-control" required value="{{ old('email') }}">
                    <label for="email">メールアドレス</label>
                </div>

                <!-- Password -->
                <div class="md-form">
                    <input type="password" id="password" name="password" class="form-control" required>
                    <label for="password">パスワード</label>
                </div>

                <!-- Password -->
                <div class="md-form">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    <label for="password_confirmation">パスワード(確認)</label>
                </div>

                <!-- Sign in button -->
                <button class="btn peach-gradient btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">ユーザー登録</button>

            </form>
            <!-- Form -->

            <div class="mt-0">
                <a href="{{ route('login') }}" class="card-text">ログインはこちら</a>
            </div>

        </div>

    </div>
    <!-- Material form subscription -->
  </div>
@endsection
