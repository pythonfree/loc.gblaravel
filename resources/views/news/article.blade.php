@include('menu')
@if($article)
    <h2>{{$article['title']}}</h2>
    <p>{{$article['text']}}</p>
@else
    Нет такой новости!
@endif
