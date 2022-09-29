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
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.index')?'active':'' }}" href="{{ route('admin.index') }}">
        Админка
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('vue')?'active':'' }}" href="{{ route('vue') }}">Vue</a>
</li>
