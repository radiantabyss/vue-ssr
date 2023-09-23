<div class="post">
    <div class="post__gallery">
        @foreach ( $item->media as $media_item )
            @include('/components/media', ['item' => $media_item])
        @endforeach
    </div>

    @include('/components/post-details')
</div>
