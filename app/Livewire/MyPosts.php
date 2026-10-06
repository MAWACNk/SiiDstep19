<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class MyPosts extends Component
{
    use WithPagination;

    #[Url]
    public $search = "";

    public function updatedSearch(){
        $this->resetPage();
    }

    public function delete($id) {
        $post = Post::find($id);

        if($post->user_id !==Auth::id()){
            abort(403);
        }

        $post->delete();

        session()->flash('status','記事を削除しました。');
    }

    public function render()
    {
        $posts = Post::where('user_id', Auth::id())
        ->where('title','like', '%' . $this->search . "%")
        ->latest()
        ->paginate(10);

        return view('livewire.my-posts', [
            'posts' => $posts
        ]);
    }
}
