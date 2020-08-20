@extends('app')

@section('title', '記事詳細')

@section('content')
  @include('nav')
  <div class="container">
    <div class="card-body d-flex flex-row mt-3">
      <i class="fas fa-user-circle fa-3x mr-1"></i>
      <div>
        <div class="font-weight-bold">
          {{ $article->user->name }}
        </div>
        <div class="font-weight-lighter">
          {{ $article->created_at->format('Y/m/d') }}
        </div>
      </div>

      @if( Auth::id() === $article->user_id )
        <!-- dropdown -->
        <div class="ml-auto card-text">
          <div class="dropdown">
            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <button type="button" class="btn btn-link text-muted m-0 p-2">
                <i class="fas fa-ellipsis-v"></i>
              </button>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="{{ route("articles.edit", ['article' => $article]) }}">
                <i class="fas fa-pen mr-1"></i>記事を更新する
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">
                <i class="fas fa-trash-alt mr-1"></i>記事を削除する
              </a>
            </div>
          </div>
        </div>
        <!-- dropdown -->

        <!-- modal -->
        <div id="modal-delete-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                  {{ $article->title }}を削除します。よろしいですか？
                </div>
                <div class="modal-footer justify-content-between">
                  <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                  <button type="submit" class="btn btn-danger">削除する</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- modal -->
      @endif

    </div>
    <!-- Card Narrower -->
    <div class="card card-cascade narrower mb-3">

      <!-- Card image -->
      <div class="view view-cascade overlay">
        <img class="card-img-top" src="https://foodgram-shinnosuketakagi.s3-ap-northeast-1.amazonaws.com/{{ $article->filename }}"
          alt="Card image cap">
        <a>
          <div class="mask rgba-white-slight"></div>
        </a>
      </div>

      <!-- Card content -->
      <div class="card-body card-body-cascade">

        <!-- Title -->
        <h4 class="font-weight-bold card-title">
          <i class="fas fa-utensils mr-1 pink-text"></i>
          {{ $article->title }}
        </h4>
        <!-- Text -->
        <p class="card-text">{{ $article->body }}</p>

        <div class="card-body pt-0 pb-2 pl-3">
          <div class="card-text">
            <article-like
              :initial-is-liked-by='@json($article->isLikedBy(Auth::user()))'
              :initial-count-likes='@json($article->count_likes)'
              :authorized='@json(Auth::check())'
              endpoint="{{ route('articles.like', ['article' => $article]) }}"
            >
            </article-like>
          </div>
        </div>

        @foreach($article->tags as $tag)
          @if($loop->first)
            <div class="card-body pt-0 pb-4 pl-3">
              <div class="card-text line-height">
          @endif
                <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
                  {{ $tag->hashtag }}
                </a>
          @if($loop->last)
              </div>
            </div>
          @endif
        @endforeach

        <div class="view view-cascade gradient-card-header peach-gradient">
          <h5 class="mb-0 p-2 text-white">Adress</h5>
        </div>
        <div class="card-body card-body-cascade text-center">
          <div id="map-container-google-9" class="z-depth-1-half map-container-5">
            <iframe src="https://maps.google.co.jp/maps?output=embed&q={{ $article->map }}" frameborder="0" style="border: 0; width: 100%;" allowfullscreen></iframe>
          </div>
        </div>
      </div>


    </div>
    <!-- Card Narrower -->
  </div>
@endsection
