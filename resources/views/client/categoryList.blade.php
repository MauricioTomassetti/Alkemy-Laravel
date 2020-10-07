<section class="container-fluid">
    <h2 class="text-center">Categorias</h2>
    <hr>
    <nav class="nav nav-pills flex-column flex-sm-row">
        @foreach($categories as $category)
            @if(!Auth::check())
            <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('guest.appcategories',$category->slug)}}">{{$category->name}} - {{$category->cantapp}} -</a>
            @else
            <a class="flex-sm-fill text-sm-center nav-link" href="{{ route('appCategory',$category->slug)}}">{{$category->name}} -  {{$category->cantapp}} -</a>
            @endif
        @endforeach
    </nav>
    <hr>
</section>





