@foreach ($messages as $message)
    <div class="chat-message">
        <strong>{{ $message->user->name }}</strong>
        <p>{{ $message->content }}</p>
        <small>{{ $message->created_at }}</small>
        @if ($message->file)
            <div class="file-attachment">
                <a href="{{ asset('storage/messages/' . $message->file) }}" download>
                    <i class="fa fa-download"></i> {{ $message->file }}
                </a>
            </div>
        @endif
    </div>
@endforeach

