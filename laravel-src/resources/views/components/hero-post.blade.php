@php
$hero_posts = [
    [ 'name' => 'Luis Mendo', 'url' => '/luismendo' ],
    [ 'name' => 'Sawdust', 'url' => '/sawdust' ],
    [ 'name' => 'burnt toast', 'url' => '/burnttoast' ],
    [ 'name' => 'Malika Favre', 'url' => '/malikafavre' ],
    [ 'name' => 'Guy Moorhouse', 'url' => '/futurefabric' ],
];
@endphp
<div class="hero-post">
    <a href="{{ $hero_posts[$i - 1]['url'] }}" class="hero-post__image">
        <img src="{{ config('app.url') }}/images/hero-post-{{ $i }}.png"
            srcset="{{ config('app.url') }}/images/hero-post-{{ $i }}@2x.png 2x"
        />
    </a>
    <a :to="{{ $hero_posts[$i - 1]['url'] }}" class="hero-post__author">
        <div>
            <img src="{{ config('app.url') }}/images/hero-author-{{ $i }}.png"
                srcset="{{ config('app.url') }}/images/hero-author-{{ $i }}@2x.png 2x"
            />
        </div>
        {{ $hero_posts[$i - 1]['name'] }}
    </a>
</div>
