@if($errors->any())
<div class="alert alert-danger" role="alert">
  <ul class="mb-0">
    @foreach($errors->all() as $error)
      <li style="list-style-type: none;">
        {{ $error }}
      </li>
    @endforeach
  </ul>
</div>
@endif