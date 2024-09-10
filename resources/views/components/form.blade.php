@props([
    'action',
    'post' => null,
    'put' => null,
    'delete' => null,
    'patch' => null,
])

<form class="max-w-sm mx-auto" action="{{ $action }}" method="POST">
    @csrf

    @if ($put)
        @method('put')
    @endif

    @if ($patch)
    @method('patch')
    @endif

    @if ($delete)
        @method('delete')
    @endif

    {{ $slot }}
    
</form>