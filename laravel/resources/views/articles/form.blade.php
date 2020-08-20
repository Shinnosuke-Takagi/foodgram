@csrf
@if(! isset($article) )
  <div class="md-form">
    <input type="file" name="filename" value="{{ $article->filename ?? old('filename') }}">
  </div>
@endif
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" value="{{ $article->title ?? old('title') }}">
</div>
<div class="form-group">
  <label></label>
  <textarea name="body" class="form-control" rows="16" placeholder="本文">{{ $article->body ?? old('body') }}</textarea>
</div>
<div class="md-form">
  <label>住所</label>
  <input type="text" name="map" class="form-control" value="{{ $article->map ?? old('map') }}">
</div>
<div class="form-group">
  <article-tags-input
    :initial-tags='@json($tagNames ?? [])'
  >
  </article-tags-input>
</div>
