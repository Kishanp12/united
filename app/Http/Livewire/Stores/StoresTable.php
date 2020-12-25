<?php

namespace App\Http\Livewire\Stores;

use App\Models\Store;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class StoresTable extends Component
{




    public function changeStatus(Store $store)
    {
        $store->update([
            'approved' => !$store->approved
        ]);
    }

    public function downloadLicense($license)
    {
        return Storage::download($license);
    }


    public function render()
    {
        return view('livewire.stores.stores-table', [
            'stores' => Store::with('user')->get()
        ]);
    }
}
