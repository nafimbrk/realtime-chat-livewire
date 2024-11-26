<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div wire:poll>
                        @foreach ($messages as $message)
                        <div class="chat @if($message->from_user_id == auth()->id()) chat-end @else chat-start @endif">
                            <div class="chat-image avatar">
                                <div class="w-10 rounded-full">
                                    <img alt="Tailwind CSS chat bubble component"
                                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                                </div>
                            </div>
                            <div class="chat-header">
                                {{ $message->fromUser->name }}
                                <time class="text-xs opacity-50">{{ $message->created_at->diffForHumans() }}</time>
                            </div>
                            <div class="chat-bubble">{{ $message->message }}</div>
                            <div class="chat-footer opacity-50">Delivered</div>
                        </div>
                        @endforeach
                    </div>

                    <div class="form-control">
                        <form action="" wire:submit.prevent='sendMessage'>
                            <textarea class="textarea textarea-bordered w-full" wire:model='message' placeholder="send your message..."></textarea>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
