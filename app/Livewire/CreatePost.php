<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title("記事作成ページ")]
class CreatePost extends Component
{
    #[Validate("required", message: "タイトルは必須です")]
    #[Validate("min:3", message: "タイトルは３文字以上で入力してください")]
    public $title = "";

    #[Validate("required", message: "本文は必須です")]
    public $body = "";

    #[Validate('required|exists:categories,id')]
    public $category_id = "";

    public function save(){
        $this->validate();

        Post::create([
            'title' => $this->title,
            'body' => $this->body,
            'user_id' => Auth::id(),
            'category_id' => $this->category_id
        ]);

        $this->reset(['title', 'body']);
        session()->flash('status','記事を投稿しました！');

        //return $this->redirect('/posts', navigate: true);
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.create-post',[
            'categories' => $categories,
        ]);
    }
}
