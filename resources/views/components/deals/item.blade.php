<a
    {{ $attributes->class('bg-gray-100/75 flex rounded-xl overflow-hidden transition-opacity hover:opacity-50')->merge([
            'href' => $href,
            'target' => '_blank',
        ]) }}>
    <div class="flex flex-col flex-1 p-4 md:p-6">
        <p class="text-xl font-medium tracking-tight text-black">
            {{ $headline }}
        </p>

        <x-prose class="flex-grow mt-4 leading-normal sm:text-balance">
            {!! Str::markdown($subheadline) !!}
        </x-prose>

        <x-btn primary
            class="mt-8 self-start cursor-pointer rounded-md! {{ $ctaColor ?? '' }} {{ $ctaTextColor ?? '' }}">
            {{ $cta }}
        </x-btn>
    </div>

    <div class="relative flex-none w-[20%] sm:w-[33.33%] lg:flex-1">
        <img loading="lazy" src="{{ $src }}" alt="{{ $name }}"
            class="object-cover absolute inset-0 w-full h-full ring-1 shadow-2xl ring-black/10 object-top-left" />
    </div>
</a>
