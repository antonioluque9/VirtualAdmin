<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Virtualhost;
use Livewire\WithPagination;

class LiveVirtualhostsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'server';
    public $sortDirection = 'desc';

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch(){
        $this->resetPage();
    }

    public function sortBy($field){
        if($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        }else{
            $this->sortDirection = 'desc';
        }
        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.live-virtualhosts-table', [
        'virtualhosts' => Virtualhost::where('servername', 'like', '%'.$this->search.'%')
            ->orWhere('virtualhost', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10),
    ])->extends('layouts.app');
    }
}
