<x-app>
    <div class="container text-center">
        <x-hero-section />
    </div>

    @if ($popular->isNotEmpty())
        <x-section title="Popular posts" id="popular" class="mt-24 md:mt-32">
            <x-posts-grid :posts="$popular" />

            <x-btn primary wire:navigate href="{{ route('blog.posts.index') }}" class="table mx-auto mt-16">
                Browse all articles
            </x-btn>
        </x-section>
    @endif

    {{-- <x-section
        title="Great deals for developers"
        class="mt-24 md:mt-32"
    >
        <div class="grid gap-8 mt-8 lg:grid-cols-2">
            <x-deals.tower />
            <x-deals.fathom-analytics />
            <x-deals.cloudways />
            <x-deals.mailcoach />
            <x-deals.wincher />
            <x-deals.uptimia />
        </div>
    </x-section> --}}

    <x-section title="Latest posts" id="latest" class="mt-24 md:mt-32">
        @if ($latest->isNotEmpty())
            <x-posts-grid :posts="$latest" />
        @endif

        <x-btn primary wire:navigate href="{{ route('blog.posts.index') }}" class="table mx-auto mt-16">
            Browse all articles
        </x-btn>
    </x-section>

    <x-section title="Latest links" id="links" class="mt-24 md:mt-32">
        @if ($links->isNotEmpty())
            <x-links-grid :$links />
        @endif

        <x-btn primary wire:navigate href="{{ route('links.index') }}" class="table mx-auto mt-16">
            Browse all links
        </x-btn>
    </x-section>

    @if ($aboutUser)
        <x-section title="About {{ $aboutUser->name }}" id="about"
            class="mt-24 lg:max-w-(--breakpoint-md) md:mt-32">
            <x-prose>
                <img loading="lazy" src="{{ $aboutUser->avatar }}" alt="{{ $aboutUser->name }}"
                    class="float-right mt-4 ml-4 rounded-full! size-20 sm:size-28 md:size-32" />

                {!! Str::markdown($aboutUser->biography) !!}
            </x-prose>
        </x-section>
    @endif
</x-app>
