<x-app :hide-ad="true" title="Unlock the best software deals for developers"
    description="Browse the great deals I gathered from across the web. Services, apps, and all kinds of tools to help you do your job more efficiently.">
    <h1
        class="px-4 font-medium tracking-tight text-center text-black text-4xl/none md:text-5xl lg:text-7xl text-balance">
        Unlock the best software deals<br class="hidden md:inline" />
        for developers
    </h1>



    <x-section title="Latest deals" class="mt-16 md:mt-24">
        <p class="px-4 -mt-6 leading-tight text-center">
            Browse the great deals I gathered from across the web.<br class="hidden md:inline" />
            Services, apps, and all kinds of tools to help you do your job more efficiently.
        </p>

        <div class="grid gap-8 mt-8 md:grid-cols-2">
            <x-deals.tower />
            <x-deals.fathom-analytics />
            <x-deals.cloudways />
            <x-deals.mailcoach />
            <x-deals.wincher />
            <x-deals.uptimia />
            <x-deals.digitalocean />
        </div>
    </x-section>
</x-app>
