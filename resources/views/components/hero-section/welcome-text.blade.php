<div class="relative w-full lg:max-w-xl lg:shrink-0 xl:max-w-2xl z-10 flex flex-col justify-center items-center">
    <p class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">
        Hello! </p>
    <h1 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">
        I'm Carlos Santos! </h1>

    <p class="mt-8 text-lg font-normal text-pretty text-gray-500 sm:max-w-lg sm:text-xl/8 lg:max-w-none">
        I'm a software engineer with a passion for building great products, following good practices and code quality.
    </p>
    <p class="font-bold mt-2">And really, I love programming and create great solutions.</p>
    <div class="mt-5 text-center md:mt-8 flex-col gap-2">
        <x-btn primary size="md" wire:navigate href="{{ route('about') }}" class="w-full">
            More about me
        </x-btn>
    </div>
</div>
