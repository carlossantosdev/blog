@auth
    <div class="px-4 py-2">
        You: {{ auth()->user()->name }}
    </div>

    <x-nav.auth-admin />

    <x-dropdown.divider />

    <x-dropdown.item icon="heroicon-o-chat-bubble-oval-left" wire:navigate href="{{ route('user.comments') }}">
        Your comments
    </x-dropdown.item>

    <x-dropdown.item icon="heroicon-o-arrow-right-end-on-rectangle" destructive form="logout-form">
        Log out
    </x-dropdown.item>

    <form method="POST" action="{{ route('logout') }}" id="logout-form" class="hidden">
        @csrf
    </form>
@else
    <x-dropdown.item icon="iconoir-github" href="{{ route('auth.redirect') }}" target="_blank">
        Sign in
    </x-dropdown.item>
@endauth
