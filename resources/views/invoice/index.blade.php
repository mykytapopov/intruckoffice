<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4 mr-2">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Invoices') }}
                </h2>
                <form action="{{ route('invoices.index') }}" method="GET">
                    <x-text-input
                            id="number"
                            name="number"
                            type="text"
                            class="mt-1 block w-full"
                            :value="Request::get('number')" />
                </form>
            </div>
            <div class="content-end">
                <form action="{{ route('invoices.index') }}" method="GET">
                    <x-select name="driver" class="mt-1 block w-full" onchange="submit()">
                        <option value="" selected>{{ __('All drivers') }}</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ Request::get('driver') == $driver->id ? 'selected' : '' }}>{{  $driver->fullName() }}</option>
                        @endforeach
                    </x-select>
                </form>
            </div>
        </div>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @foreach ($invoices as $invoice)
                <div id="{{ $invoice->number }}"
                     class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden text-gray-900 dark:text-gray-100"
                     x-data="{
                        invoiceOpen: false,
                        init() {
                            const params = new URLSearchParams(window.location.search)
                            this.invoiceOpen = params.get('number') === '{{ $invoice->number }}'
                        },
                        get isInvoiceOpen() { return this.invoiceOpen }
                     }"
                >
                    <div class="grid gap-4 sm:grid-cols-3 text-sm sm:text-md justify-items-center items-center"
                         @click="invoiceOpen = !invoiceOpen"
                    >
                        <div class=text-center">{{ $invoice->number }}</div>
                        <div class=text-center">{{ $invoice->created_at }}</div>
                        <div>$ {{ $invoice->total }}</div>
                    </div>
                    <div x-show="isInvoiceOpen" class="pt-4 space-y-2" style="display: none;">
                        <pre class="m-2 p-4 bg-gray-700 whitespace-pre-wrap">{!! $invoice->generated_log !!}</pre>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
