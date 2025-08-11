@if (auth()->user()->isAdmin())
    <x-dropdown.divider />

    <x-dropdown.item icon="heroicon-o-adjustments-horizontal" href="{{ route('filament.admin.pages.dashboard') }}">
        Admin
    </x-dropdown.item>

    <x-dropdown.item icon="icon-horizon" href="{{ route('horizon.index') }}">
        Horizon
    </x-dropdown.item>
@endif
