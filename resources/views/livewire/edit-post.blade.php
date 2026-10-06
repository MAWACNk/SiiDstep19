<div class="max-w-2xl mx-auto p-6">
    <flux:heading size="xl" level="1" class="mb-5">記事編集ページ</flux:heading>

    <form wire:submit="update" class="space-y-6">
        <flux:input wire:model="title" label="タイトル" placeholder="記事のタイトルを入力" />
        <flux:textarea wire:model="body" label="本文" rows="5" placeholder="本文を入力" />
        <div class="flex justify-end gap-5">
            <flux:button href="{{ route('my-posts') }}" wire:navigate>
                キャンセル
            </flux:button>
            <flux:button type="submit" variant="primary">
                更新する
            </flux:button>
        </div>
    </form>
</div>
