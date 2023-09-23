<div class="comment">
    <div class="comment__details">
        <div class="comment__name">{{ $item->user->meta->public_name ?? $item->user->meta->username }}</div>
        <div class="comment__date">{{ $item->created_at }}</div>
    </div>
    <div class="comment__content">{{ $item->content }}</div>
</div>
