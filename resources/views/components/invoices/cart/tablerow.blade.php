@props([
    'product', 'invoice'
    ])
<tr>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-900">{{$product->name}}</div>
      </td>

    <td class="px-6 py-4 whitespace-nowrap">
      <div class="flex items-center">

        <div class="">
          <div class="text-sm font-medium text-gray-900">
            ${{$product->price}}
          </div>
        </div>
      </div>
    </td>

    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        <div class="flex">
            @if ($invoice->status == 0)
            <a wire:click="minus({{$product}})" class="px-2 bg-gray-200 cursor-pointer">-</a>
            @endif

            <label class="px-2 bg-gray-200">{{$product->pivot->quantity}}</label>

            @if ($invoice->status == 0)
            <a wire:click="add({{$product}})"  class="px-2 bg-gray-200 cursor-pointer">+</a>
            @endif

        </div>

    </td>


    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">

          <div class="">
            <div class="text-sm font-medium text-gray-900">
             ${{$product->price * $product->pivot->quantity}}
            </div>
          </div>
        </div>
    </td>


  </tr>
