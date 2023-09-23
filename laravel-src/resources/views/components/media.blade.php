<div class="media">
    <div>
        @if ( $item->type == 'image' )
            <img src="{{ config('path.uploads_url').$item->path }}" />
        @else
            <video muted loop webkit-playsinline="true" playsinline="true" poster="{{ config('path.uploads_url').$item->cover_path }}">
                <source src="{{ config('path.uploads_url').$item->path }}" />
            </video>
        @endif
    </div>
</div>
