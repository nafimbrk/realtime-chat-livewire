<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public User $user;
    public $message = '';

    public function render()
    {
        // versi yg bug tapi malah jadi kayak fitur chat grup
        // return view('livewire.chat', [
        //     'messages' => Message::where('from_user_id', Auth::id())
        //     ->orWhere('from_user_id', $this->user->id)
        //     ->orWhere('to_user_id', Auth::id()) 
        //     ->orWhere('to_user_id', $this->user->id)
        //     ->get() 
        // ]);

        return view('livewire.chat', [
            'messages' => Message::where(function (Builder $query) {
                $query->where('from_user_id', Auth::id())
                    ->where('to_user_id', $this->user->id);
            })->orWhere(function (Builder $query) {
                $query->where('from_user_id', $this->user->id)
                ->where('to_user_id', Auth::id());
            })
                ->get()
        ]);
    }

    public function sendMessage()
    {
        // dd($this->message);

        Message::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $this->user->id,
            'message' => $this->message
        ]);

        $this->reset('message');
    }
}
