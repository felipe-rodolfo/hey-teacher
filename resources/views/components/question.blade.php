@props([
  'question'
])

<div class="flex items-center justify-between p-3 text-black bg-white rounded shadow-lg dark:bg-gray-800/50 dark:text-white">
  <span>{{ $question->question }}</span>
  <span>
    <x-form :action="route('question.like', $question)" method="POST">
      <button class="flex items-start space-x-2">
        <x-icons.thumbs-up class='w-5 h-5 text-green-300 cursor-pointer hover:text-green-500' />
        <span>
          {{ $question->votes_sum_like ?: 0 }}
        </span>
      </button>
    </x-form>
    <x-form :action="route('question.unlike', $question)" method="POST">  <button class="flex items-start space-x-2">
        <x-icons.thumbs-down class='w-5 h-5 text-red-300 cursor-pointer hover:text-red-500' />
        <span>
          {{ $question->votes_sum_unlike ?: 0 }}  </span>
      </button>
    </x-form>
  </span>
</div>
