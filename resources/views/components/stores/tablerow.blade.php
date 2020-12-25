@props([
    'store'
])
<tr>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-900">{{ $store->name }}</div>
        <div class="text-sm text-gray-500">{{ $store->address }}</div>
      </td>

    <td class="px-6 py-4 whitespace-nowrap">
      <div class="flex items-center">

        <div class="">
          <div class="text-sm font-medium text-gray-900">
            {{ $store->user->name }}
          </div>
          <div class="text-sm text-gray-500">
            {{ $store->user->email }}
          </div>
        </div>
      </div>
    </td>

    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        <a wire:click="downloadLicense('{{$store->license}}')" class="cursor-pointer text-indigo-600 hover:text-indigo-900">Download License</a>
    </td>

    <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $store->status_color }}">
            {{ $store->status }}
        </span>
      </td>

    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
      <a wire:click="changeStatus({{$store}})" class="cursor-pointer text-indigo-600 hover:text-indigo-900">Change Status</a>
    </td>
  </tr>
