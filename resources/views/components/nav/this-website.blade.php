<x-dropdown.divider>
    This Website
</x-dropdown.divider>

<x-dropdown.item icon="heroicon-o-tag" wire:navigate href="{{ route('blog.categories.index') }}">
    Blog Categories
</x-dropdown.item>

{{-- <x-dropdown.item icon="heroicon-o-tag" wire:navigate href="{{ route('blog.categories.index') }}">
    Events
</x-dropdown.item> --}}
