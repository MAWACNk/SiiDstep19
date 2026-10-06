<div class="mx-w-4xl mx-auto p-6 space-y-6">
    <flux:heading size="xl" level="1" class="mb-5">自分の記事投稿一覧</flux:heading>

    <div class="flex justify-between items-center mb-6 gap-4 mt-6">
        <flux:input wire:model.live="search" icon="magnifying-glass" class="w-64" placeholder="タイトルで検索" />
        
        @auth
            <flux:button href="{{ route('posts.create') }}" wire:navigate variant="primary">
                新規作成
            </flux:button>
        @endauth
    </div>
        
        @if (session('status'))
            <div class="p-4 bg-green-100 text-green-700 rounded">
                {{ session('status') }}
            </div>
        @endif

        @foreach ($posts as $post)
            <article class="p-4 shadow-lg">
                <flux:text class="mt-4 mb-2">{{ $post->created_at->format('y/m/d') }}</flux:text>
                <flux:heading size="lg" level="2">{{ $post->title }}</flux:heading>
                <div class="flex items-center gap-2 shrink-0 mt-2">
                    <flux:button 
                    href="posts/{{ $post->id }}/edit"
                    wire:navigate
                    icon="pencil-square"
                    size="sm"
                    >編集</flux:button>

                    <flux:button 
                    wire:click="delete({{ $post->id }})"
                    wire:confirm="本当に削除しますか？"
                    variant="danger"
                    icon="trash"
                    size="sm"
                    >削除</flux:button>
                </div>
            </article>
        @endforeach

        {{ $posts->links() }}
</div>
