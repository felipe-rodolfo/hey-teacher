@props([
    'question'
])

<div class="p-3 text-black bg-white rounded shadow-lg dark:bg-gray-800/50 dark:text-white">
    {{ $question->question }}
</div>