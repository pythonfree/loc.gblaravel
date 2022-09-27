@include('menu')
<h2>Новости:</h2>

<ul>
@foreach ($categories as $category)
    <li>
        <a href="{{ route('category', $category['id']) }}">{{ $category['title'] }}</a>
    </li>
@endforeach
</ul>
