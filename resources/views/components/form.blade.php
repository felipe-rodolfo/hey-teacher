@props([
    'action',
    'post' => null,
    'put' => null,
    'delete' => null,
])

<form class="max-w-sm mx-auto" action="{{ $action }}" method="POST">
    @csrf

    @if ($put)
        @method('put')
    @endif

    @if ($delete)
        @method('delete')
    @endif

    {{ $slot }}
    
</form>