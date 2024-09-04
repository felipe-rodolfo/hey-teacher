<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('My Questions') }}
        </x-header>
    </x-slot>

    <x-container>
        <x-form :action="route('question.store')">
            <x-textarea label="Question" name="question" />

            <x-btn.primary>Save</x-btn.primary>
            <x-btn.reset>Cancel</x-btn.reset>
        </x-form>

        <hr class="my-4 border-gray-700 border-dashed">

        <div class="mb-1 font-bold uppercase dark:text-gray-400">
            Drafts
        </div>

        <div class="space-y-4 dark:text-gray-400">
            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Actions</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                    @foreach($questions->where('draft', true) as $question)
                    <x-table.tr>
                        <x-table.td>{{ $question->question }}</x-table.td>
                        <x-table.td>
                            <x-form :action="route('question.destroy', $question)" delete>
                                <button type="submit" class="text-blue-500 hover:underline">
                                    Deletar
                                </button>
                            </x-form>

                            <x-form :action="route('question.publish', $question)" put>
                                <button type="submit" class="text-blue-500 hover:underline">
                                    Publicar
                                </button>
                            </x-form>

                            <a href="{{ route('question.edit', $question) }}" class="text-blue-500 hover:underline">Editar</a>
                        </x-table.td>
                    </x-table.tr>
                    @endforeach
                </tbody>
            </x-table>

        </div>

        <hr class="my-4 border-gray-700 border-dashed">

        <div class="mb-1 font-bold uppercase dark:text-gray-400">
            My Questions
        </div>

        <div class="space-y-4 dark:text-gray-400">
            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Actions</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                    @foreach($questions->where('draft', false) as $question)
                    <x-table.tr>
                        <x-table.td>{{ $question->question }}</x-table.td>
                        <x-table.td>
                            <x-form :action="route('question.destroy', $question)" delete>
                                <button type="submit" class="text-blue-500 hover:underline">
                                    Deletar
                                </button>
                            </x-form>

                            <a href="{{ route('question.edit', $question)}}" class="text-blue-500 hover:underline">Editar</a>
                        </x-table.td>
                    </x-table.tr>
                    @endforeach
                </tbody>
            </x-table>

        </div>
    </x-container>
</x-app-layout>