<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $total_posts = Post::count();
        $total_my_posts = Post::where('user_id', Auth::id())->count();
        $total_users = User::count();


        return view('livewire.dashboard', [
            'total_posts' => $total_posts,
            'total_my_posts' => $total_my_posts,
            'total_users' => $total_users
        ]);
    }
}
