<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="mx-auto my-5 max-w-7xl sm:px-6 lg:px-8" >            
        <x-form post :action="route('question.store')">
            
            <x-textarea name="question" label='Question'></x-textarea>
            <x-btn.primary type="submit">
                Send
            </x-btn.primary>
            <x-btn.reset type="reset">
                Cancel
            </x-btn.reset>
                
        </x-form>

        <hr class="mt-4 border-gray-700 border-dashed">

        <div class="flex justify-center py-5 mb-1 font-bold uppercase dark:text-gray-400">List of Questions</div>

        <div class="space-y-4 dark:text-gray-400">

            @foreach ($questions as $item)
                <x-question :question="$item" />
            @endforeach
            
        </div>
    </div>
</x-app-layout>
