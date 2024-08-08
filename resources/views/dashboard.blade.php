<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" >
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            <x-form post :action="route('question.store')">
                
                <x-textarea name="question" label='Question'></x-textarea>
                <x-btn.primary type="submit">
                    Send
                </x-btn.primary>
                <x-btn.reset type="reset">
                    Cancel
                </x-btn.reset>
                    
            </x-form>
        </div>
    </div>
</x-app-layout>
