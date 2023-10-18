<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Work') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form method="post" action="{{ route('works.store') }}" class="mt-4 space-y-4">
                    @csrf
                    @method('post')
                    @include('work.partials.form-fields')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
