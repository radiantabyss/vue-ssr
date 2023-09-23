<div class="post__details post--with-author">
    <div class="post__author">
        <a href="/{{ $item->user->meta->username }}">
            <div class="post__author-image">
                @if ( $item->user->meta->image_url )
                    <img src="{{ config('path.uploads_url').$item->user->meta->image_url }}" />
                @else
                    <img src="/images/profile.jpg" />
                @endif
            </div>
            {{ $item->user->meta->public_name }}
        </a>
    </div>
    @if ( $item->content_parsed )
        <div class="post__content">{{ $item->content_parsed }}</div>
    @endif

    <div class="post__actions {{ $item->type == 'product' ? ' post__actions--product' : '' }}">
        @if ( $item->type == 'product' )
            <div class="post__product">
                <a href="{{ $item->product_url ?? '' }}" class="btn" target="_blank">
                    Get <sprite id="arrow-up-right" />
                </a>
                @if ( isset($item->price) && $item->price )
                    <div>${{ $item->price }}</div>
                @endif
                <div>{{ ucwords($item->product_category ?? '' ) }}</div>
            </div>
        @endif
    </div>
</div>
