<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Edit Question') }} :: {{ $question->id }}
        </x-header>
    </x-slot>

    <x-container>
        <x-form :action="route('question.update', $question->id)">
            @method('put')
            <x-textarea label="Question" name="question" :value="$question->question" />

            <x-btn.primary>Save</x-btn.primary>
            <x-btn.reset>Cancel</x-btn.reset>
        </x-form>

        <hr class="my-4 border-gray-700 border-dashed">

    </x-container>
</x-app-layout>