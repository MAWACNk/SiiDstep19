<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditPost extends Component
{
    public Post $post;

    #[Validate('required|min:3')]
    public $title = '';

    #[Validate('required')]
    public $body = '';

    #[Validate('required|exists:categories,id')]
    public $category_id = "";

    public function mount(Post $post) {
        if($post->user_id !== Auth::id()){
            abort(403);
        }

        $this->post = $post;
        $this->title = $post->title;
        $this->body = $post->body;
        $this->category_id = $post->category_id;
    }
    
    public function update(){
        $this->validate();

        if($this->post->user_id !== Auth::id()){
            abort(403);
        }

        $this->post->update([
            'title' => $this->title,
            'body' => $this->body,
            'category_id' => $this->category_id,
        ]);
        session()->flash('status','記事を更新しました。');

        return $this->redirect('/my-posts', navigate: true);
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.edit-post', [
            'categories' => $categories,
        ]);
    }
}
