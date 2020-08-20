@extends('app')

@section('title', 'ログイン')

@section('content')
  <div class="container">
    <!-- Material form subscription -->
    <div class="card mt-3">

        <h5 class="card-header peach-gradient white-text text-center py-4">
            <strong>ログイン</strong>
        </h5>

        @include('error_card_list')

        <!--Card content-->
        <div class="card-body px-lg-5">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" method="POST" action="{{ route('login') }}">
              @csrf

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

                <input type="hidden" name="remember" id="remember" value="on">

                <!-- Sign in button -->
                <button class="btn peach-gradient btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">ログイン</button>

            </form>
            <!-- Form -->

            <div class="mt-0">
                <a href="{{ route('register') }}" class="card-text">ユーザー登録はこちら</a>
            </div>

        </div>

    </div>
    <!-- Material form subscription -->
  </div>
@endsection
