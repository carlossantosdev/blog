<x-app>
    <div class="container text-center">
        <x-hero-section />
    </div>

    <x-section title="Latest posts" id="latest" class="mt-24 md:mt-32">
        @if ($latest->isNotEmpty())
            <x-posts-grid :posts="$latest" />
        @endif

        <x-btn primary wire:navigate href="{{ route('blog.posts.index') }}" class="table mx-auto mt-16">
            Browse all articles
        </x-btn>
    </x-section>

    @if ($popular->isNotEmpty())
        <x-section title="Popular posts" id="popular" class="mt-24 md:mt-32">
            <x-posts-grid :posts="$popular" />

            <x-btn primary wire:navigate href="{{ route('blog.posts.index') }}" class="table mx-auto mt-16">
                Browse all articles
            </x-btn>
        </x-section>
    @endif

</x-app>
