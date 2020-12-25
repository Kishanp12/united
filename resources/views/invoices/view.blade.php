<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoice') }} {{$invoice->id}}
        </h2>

        @if ($invoice->status == 0)
         <livewire:invoices.submit-invoice :invoice="$invoice"/>
        @endif



        </div>
    </x-slot>

    <div class="py-12 flex justify-content-between">
        <div class="w-1/2  mx-auto sm:px-6 lg:px-8">
            <livewire:products.products-table :invoice="$invoice" />
        </div>

    {{-- invoice --}}
        <div class="w-1/2  mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:invoices.invoice-cart :invoice="$invoice" />
            </div>
        </div>

    </div>
</x-app-layout>
