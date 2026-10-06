<div class="spave-y-4">
    <flux:heading size="lg" level="1">記事一覧ページ</flux:heading>

    <div class="flex justify-between items-center mb-6 gap-4 mt-6">

        <flux:input wire:model.live="search" icon="magnifying-glass" class="w-64" placeholder="タイトルで検索" />
        
        @auth
            <flux:button href="{{ route('posts.create') }}" wire:negative variant="primary">
                新規作成
            </flux:button>
        @endauth
    </div>
        
        @foreach ($posts as $post)
            <article class="p-4 shadow-lg">
                <a href="/posts/{{ $post->id }}">
                    <flux:text class="mt-4">{{ $post->created_at->format('y/m/d') }}</flux:text>
                    <flux:heading size="lg" level="2">{{ $post->title }}</flux:heading>
                    <flux:text class="mt-2">{{ Str::limit($post->body, 100) }}</flux:text>
                    <flux:text class="mt-4">投稿者: {{ $post->user->name }}</flux:text>
                </a>
            </article>
        @endforeach
        {{ $posts->links() }}
</div>
