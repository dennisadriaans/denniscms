<div class="row">
    @foreach ($item as $category)
        <div class="card small-12 column">
            {{$category->title}}
        </div>
    @endforeach
</div>

