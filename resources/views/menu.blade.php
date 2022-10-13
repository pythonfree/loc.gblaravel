<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('home')?'active':'' }}" href="{{ route('home') }}">
        Главная
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('news.index')?'active':'' }}" href="{{ route('news.index') }}">
        Новости
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('news.categories.index')?'active':'' }}" href="{{ route('news.categories.index') }}">
        Категории
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('about')?'active':'' }}" href="{{ route('about') }}">
        О проекте
    </a>
</li>
@if($user = Auth::user())
    @if($user->is_admin)
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('vue')?'active':'' }}" href="{{ route('vue') }}">Vue</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.news.index')?'active':'' }}" href="{{ route('admin.news.index') }}">
                Админка
            </a>
        </li>
    @endif
@endif
