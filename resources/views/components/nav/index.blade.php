<nav {{ $attributes->class('flex items-center gap-6 md:gap-8 font-normal text-xs') }}>
    <a wire:navigate href="{{ route('home') }}"
        class="flex gap-3 items-center text-black transition-colors hover:text-blue-600">
        <div class="relative">
            <x-codicon-terminal-bash class="h-10 fill-current md:h-12" />
        </div>

        <span class="text-base font-bold tracking-widest uppercase sr-only md:not-sr-only">
            carlossantosdev.com
        </span>
    </a>

    <div class="grow"></div>

    <x-nav.item active-icon="heroicon-s-fire" icon="heroicon-o-fire" href="{{ route('blog.posts.index') }}">
        Latest
    </x-nav.item>

    <x-nav.item active-icon="si-laravel" icon="fab-laravel" href="{{ route('blog.categories.show', 'laravel') }}">
        Laravel
    </x-nav.item>

    <x-nav.item active-icon="eos-ai" icon="eos-ai" href="{{ route('blog.categories.show', 'ai') }}">
        AI
    </x-nav.item>

    <x-dropdown>
        <x-slot:btn>
            @auth
                <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}'s GitHub avatar"
                    class="mx-auto rounded-full size-6 md:size-7" />

                Account
            @else
                <x-heroicon-o-ellipsis-horizontal class="mx-auto transition-transform size-6 md:size-7"
                    x-bind:class="{ 'rotate-90': open }" />

                More
            @endauth
        </x-slot>

        <x-slot:items>

            <x-nav.auth />

            <x-nav.this-website />

            <x-nav.carlos-santos />

            <x-nav.fork />

        </x-slot>
    </x-dropdown>
</nav>
