<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Backup;
use Livewire\WithPagination;

class LiveBackupsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'started';
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
        return view('livewire.live-backups-table', [
            'backups' => Backup::where('servername', 'like', '%'.$this->search.'%')
                ->orWhere('domains', 'like', '%'.$this->search.'%')
                ->orWhere('status', 'like', '%'.$this->search.'%')
                ->orWhere('started', 'like', '%'.$this->search.'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(8)
        ])->extends('layouts.app');
    }
}
