<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout("components.layouts.guest")]
#[Title("記事一覧ページ")]
class ShowPosts extends Component
{
    use WithPagination;

    #[Url]
    public $search = "";
    public $category_id = "";

    public function updatedSearch(){
        $this->resetPage();
    }

    public function updatedCategoryId()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $categories = Category::all();

        $posts = Post::with(['user', 'category'])
        ->where('title','like', '%' . $this->search . "%")
        ->when($this->category_id, function($query) {
            $query->where('category_id', $this->category_id);
        })
        ->latest()
        ->paginate(10);

        return view('livewire.show-posts',[
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }
}
