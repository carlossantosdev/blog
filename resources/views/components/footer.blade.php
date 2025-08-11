<div {{ $attributes->class('bg-gray-100') }}>
    <footer class="container py-8 lg:max-w-(--breakpoint-md) *:[&_a]:underline *:[&_a]:font-medium">
        <nav class="flex flex-col md:flex-row items-center justify-center gap-4">
            <a wire:navigate href="{{ route('home') }}">Home</a>
            <a wire:navigate href="{{ route('blog.posts.index') }}">Articles</a>
            <a wire:navigate href="{{ route('blog.categories.index') }}">Categories</a>
            <a href="{{ route('about') }}">About</a>
            <a href="mailto:carlos.santos.dev@gmail.com">Contact</a>
        </nav>

        <p class="mt-8 text-center text-balance">
            carlossantosdev.com © 2025
        </p>
    </footer>
</div>
