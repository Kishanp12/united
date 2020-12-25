@props([
    'invoice'
])
<tr>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-900">{{ $invoice->store->name }}</div>
        <div class="text-sm text-gray-500">{{ $invoice->store->address }}</div>
      </td>

    <td class="px-6 py-4 whitespace-nowrap">
      <div class="flex items-center">

        <div class="">
          <div class="text-sm font-medium text-blue-900">
            {{$invoice->products()->count() }}
          </div>
        </div>
      </div>
    </td>

    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-500">
        ${{$invoice->balance}}
    </td>

    <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $invoice->stat_color }}">
            {{ $invoice->stat }}
        </span>
      </td>

    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
      <a href="{{route('invoices.view', $invoice->id)}}" class="cursor-pointer text-indigo-600 hover:text-indigo-900">View Invoice</a>
    </td>
  </tr>
