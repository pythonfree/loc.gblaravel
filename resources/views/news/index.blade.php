@include('menu')
<h2>Новости:</h2>

<ul>
@forelse($news as $article)
    <li>
        <a href="{{route('article', $article['id'])}}">{{$article['title']}}</a>
    </li>
@empty
    Нет новостей
@endforelse
</ul>
