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

    public function sortBy($field){
        if($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }else{
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.live-backups-table', [
            'backups' => Backup::where('server', 'like', '%'.$this->search.'%')->orderBy($this->sortField, $this->sortDirection)->paginate(10),
        ]);
    }
}
