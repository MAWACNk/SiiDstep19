<div class="max-w-2xl mx-auto p-6">
    <flux:heading size="xl" level="1" class="mb-5">記事作成ページ</flux:heading>

    @if (session('status'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit="save" class="space-y-6">
        <flux:input wire:model="title" label="タイトル" placeholder="記事のタイトルを入力" />
        <flux:textarea wire:model="body" label="本文" rows="5" placeholder="本文を入力" />
        <div class="flex justify-end">
            <flux:button type="submit" variant="primary">
                投稿する
            </flux:button>
        </div>
    </form>
</div>
