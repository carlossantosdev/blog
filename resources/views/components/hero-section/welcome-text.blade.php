<div class="relative w-full lg:max-w-xl lg:shrink-0 xl:max-w-2xl z-10 flex flex-col justify-center items-center">
    <h1 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">
        Hello. Welcome!</h1>
    <p class="mt-8 text-lg font-normal text-pretty text-gray-500 sm:max-w-lg sm:text-xl/8 lg:max-w-none">
        My name is <u>Carlos Santos</u>, and I’m 32 years old. I’m passionate about
        development and programming, and I love to explore new technologies.</p>
    <p class="font-bold mt-2">And really, I love programming and create great solutions.</p>
    <div class="mt-5 text-center md:mt-8 flex-col gap-2">
        <x-btn primary size="md" wire:navigate href="{{ route('about') }}" class="w-full">
            More about me
        </x-btn>
    </div>
</div>
