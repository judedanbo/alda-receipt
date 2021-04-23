@props([
    'message' => false,
])

@if ($message)
    <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
@endif
