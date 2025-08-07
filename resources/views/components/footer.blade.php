<div {{ $attributes->class('bg-gray-100') }}>
    <footer class="container py-8 lg:max-w-(--breakpoint-md) *:[&_a]:underline *:[&_a]:font-medium">
        <nav class="grid grid-cols-2 gap-y-2 gap-x-6 sm:grid-cols-5 md:grid-cols-6 sm:place-items-center">
            <a wire:navigate href="{{ route('home') }}">Home</a>
            <a wire:navigate href="{{ route('blog.posts.index') }}">Articles</a>
            <a wire:navigate href="{{ route('blog.categories.index') }}">Categories</a>
            <a href="{{ route('home') }}#about">About</a>
            <a href="mailto:carlos.santos.dev@gmail.com">Contact</a>
        </nav>

        {{-- <p class="mt-8 text-center text-balance">
            My blog is hosted on <a href="{{ route('merchants.show', 'digitalocean') }}"
                target="_blank">DigitalOcean</a>. Analytics provided by <a
                href="{{ route('merchants.show', 'pirsch-analytics') }}" target="_blank">Pirsch</a>.
        </p> --}}
    </footer>
</div>
