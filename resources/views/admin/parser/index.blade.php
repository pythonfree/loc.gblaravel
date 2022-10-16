@extends('layouts.main')

@section('title', 'Новости с RSS канала')

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        @php
                            $rssLink = App\Http\Controllers\Admin\AdminParserController::RSS_LINK;
                        @endphp
                        Новости с RSS канала -
                        <a href="{{ $rssLink  }}" target="_blank">
                            {{ $rssLink }}
                        </a>
                        от
                        <a href="{{ $mainTitle['link'] }}">
                            {{ $mainTitle['title'] }}
                        </a>
                    </div>
                    <div class="card-body">
                        @forelse($news as $key => $article)
                            <div class="d-flex flex-row align-items-center justify-content-center mb-1">
                                <div class="mr10">{{ ++$key }}</div>
                                <div class="card-img mr10" style="background-image: url(
                                            {{ $article['enclosure::url'] ?? asset('assets/img/default-news.png') }}
                                        )">
                                </div>
                                <div class="col-md-8">
                                    {{ $article['title'] }} ({{ date('j F, Y', strtotime($article['pubDate'] )) }})
                                </div>
                                <div class="col-md-2" style="text-align: center">
                                    <a href="{{ $article['link'] }}" target="_blank">
                                        Подробнее >>>
                                    </a>
                                </div>
                            </div>
                        @empty
                            Нет новостей
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
