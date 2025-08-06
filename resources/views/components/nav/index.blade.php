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

    @auth
        <x-dropdown>
            <x-slot:btn>
                <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}'s GitHub avatar"
                    class="mx-auto rounded-full size-6 md:size-7" />

                Account
            </x-slot>

            <x-slot:items>
                <div class="px-4 py-2">
                    {{ auth()->user()->name }}
                </div>

                <x-dropdown.divider />

                @if (auth()->user()->isAdmin())
                    <x-dropdown.item icon="heroicon-o-adjustments-horizontal"
                        href="{{ route('filament.admin.pages.dashboard') }}">
                        Admin
                    </x-dropdown.item>

                    <x-dropdown.item icon="icon-horizon" href="{{ route('horizon.index') }}">
                        Horizon
                    </x-dropdown.item>
                @endif

                <x-dropdown.divider />

                <x-dropdown.item icon="heroicon-o-chat-bubble-oval-left" wire:navigate href="{{ route('user.comments') }}">
                    Your comments
                </x-dropdown.item>

                <x-dropdown.item icon="heroicon-o-link" wire:navigate href="{{ route('user.links') }}">
                    Your links
                </x-dropdown.item>

                <x-dropdown.item icon="heroicon-o-arrow-right-end-on-rectangle" destructive form="logout-form">
                    Log out
                </x-dropdown.item>

                <form method="POST" action="{{ route('logout') }}" id="logout-form" class="hidden">
                    @csrf
                </form>
            </x-slot>
        </x-dropdown>
    @endauth

    <x-dropdown>
        <x-slot:btn>
            <x-heroicon-o-ellipsis-horizontal class="mx-auto transition-transform size-6 md:size-7"
                x-bind:class="{ 'rotate-90': open }" />
            More
        </x-slot>

        <x-slot:items>
            <x-dropdown.divider>
                More
            </x-dropdown.divider>

            <x-dropdown.item icon="heroicon-o-tag" wire:navigate href="{{ route('blog.categories.index') }}">
                Categories
            </x-dropdown.item>

            <x-dropdown.item icon="heroicon-o-question-mark-circle" href="{{ route('home') }}#about">
                About me
            </x-dropdown.item>

            <x-dropdown.item icon="heroicon-o-envelope" href="mailto:carlos.santos.dev@gmail.com">
                Contact me
            </x-dropdown.item>

            <x-dropdown.divider>
                Follow me
            </x-dropdown.divider>

            <x-dropdown.item icon="iconoir-github" href="https://github.com/carlossantosdev" target="_blank">
                GitHub
            </x-dropdown.item>

            <x-dropdown.item icon="iconoir-linkedin" href="https://www.linkedin.com/in/carlossantosdev" target="_blank">
                LinkedIn
            </x-dropdown.item>

            <x-dropdown.item icon="iconoir-x" href="https://x.com/carlossantosdev" target="_blank">
                X
            </x-dropdown.item>

            <x-dropdown.divider>
                This blog
            </x-dropdown.divider>

            <x-dropdown.item icon="iconoir-git-fork"
                description="This blog is open source and the codebase becomes bigger fast. There's a lot to learn and this is free."
                href="https://github.com/carlossantosdev/blog" target="_blank">
                Fork the source code
            </x-dropdown.item>

        </x-slot>
    </x-dropdown>
</nav>
