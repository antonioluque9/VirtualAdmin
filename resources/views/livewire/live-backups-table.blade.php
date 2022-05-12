
    <div class="container-xl">
        <div class="row justify-content-between mt-5 pt-4">
            <div class="col-4 w-25">
                <input wire:model="search" class="form-control" placeholder="Buscar"/>
            </div>
            <div class="pagination justify-content-end col-4">
                {{$backups->links('')}}
            </div>
        </div>
        @if($backups->count())
            <table class="table align-middle mb-0 mt-3 bg-white">
                <thead class="bg-light">
                <tr>
                    <th>
                        <a wire:click="sortBy('server')" role="button" href="#" class="text-decoration-none text-black">
                            Servidor
                            <i class="bi bi-arrow-down-up"></i>
                        </a>
                    </th>
                    <th>VirtualHosts</th>
                    <th class="col-2">VirtualHosts fallidos</th>
                    <th>
                        <a wire:click="sortBy('status')" role="button" href="#" class="text-decoration-none text-black">
                            Estado
                            <i class="bi bi-arrow-down-up"></i>
                        </a>
                    </th>
                    <th>
                        <a wire:click="sortBy('type')" role="button" href="#" class="text-decoration-none text-black">
                            Tipo
                            <i class="bi bi-arrow-down-up"></i>
                        </a>
                    </th>
                    <th>
                        <a wire:click="sortBy('size')" role="button" href="#" class="text-decoration-none text-black">
                            Tamaño
                            <i class="bi bi-arrow-down-up"></i>
                        </a>
                    </th>
                    <th>
                        <a wire:click="sortBy('started')" role="button" href="#" class="text-decoration-none text-black">
                            Comenzó
                            <i class="bi bi-arrow-down-up"></i>
                        </a>

                    </th>
                    <th>
                        <a wire:click="sortBy('ended')" role="button" href="#" class="text-decoration-none text-black">
                            Finalizó
                            <i class="bi bi-arrow-down-up"></i>
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody wire:loading.class.delay="opacity-50">
                @foreach($backups as $backup)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <p class="fw-bold mb-1">{{$backup->servername}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{$backup->domains}}</p>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{$backup->failed}}</p>
                        </td>
                        <td>
                            @if($backup->status === "OK")
{{--                                <p class="fw-normal mb-1 text-success">{{$backup->status}}</p>--}}
                                <span class="badge w-75 bg-success">OK</span>
                            @elseif($backup->status === "PARTIAL")
{{--                                <p class="fw-normal mb-1 text-warning">{{$backup->status}}</p>--}}
                                <span class="badge w-75 bg-warning">PARTIAL</span>
                            @else
{{--                                <p class="fw-normal mb-1 text-danger">{{$backup->status}}</p>--}}
                                <span class="badge w-75 bg-danger">FAILED</span>
                            @endif
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{$backup->type}}</p>
                        </td>
                        <td>
                            @if($backup->size === "NULL")
                                <p class="fw-normal mb-1">0 MiB</p>
                            @else
                                <p class="fw-normal mb-1">{{$backup->size}}</p>
                            @endif
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{$backup->started}}</p>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{$backup->ended}}</p>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="m-2 mb-5 text-end">De {{($backups->currentpage()-1)*$backups->perpage()+1}} a {{$backups->currentpage()*$backups->perpage()}}
                de  {{$backups->total()}} resultados
            </div>
        @else
            <div class="alert alert-warning mt-3">
                No existen resultados
            </div>
        @endif
    </div>

