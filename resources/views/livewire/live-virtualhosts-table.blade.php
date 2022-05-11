
    <div class="container-xl">
        <div class="row justify-content-between mt-5 pt-4">
            <div class="col-4 w-25">
                <input wire:model="search" class="form-control" placeholder="Buscar"/>
            </div>
            <div class="pagination justify-content-end col-4">
                {{$virtualhosts->links('')}}
            </div>
        </div>
        @if($virtualhosts->count())
            <table class="table align-middle mb-0 mt-3 bg-white">
                <thead class="bg-light">
                <th>
                    <a wire:click="sortBy('server')" role="button" href="#" class="text-decoration-none text-black">
                        Servidor
                        <i class="bi bi-arrow-down-up"></i>
                    </a>
                </th>
                <th>
                    <a wire:click="sortBy('virtualhost')" role="button" href="#" class="text-decoration-none text-black">
                        VirtualHosts
                        <i class="bi bi-arrow-down-up"></i>
                    </a>
                </th>
                <th>
                    <a wire:click="sortBy('username')" role="button" href="#" class="text-decoration-none text-black">
                        Usuario
                        <i class="bi bi-arrow-down-up"></i>
                    </a>
                </th>
                <th>Descripción</th>
                </thead>
                <tbody wire:loading.class.delay="opacity-50">
                @foreach($virtualhosts as $virtualhost)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <p class="fw-bold mb-1">{{$virtualhost->servername}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{$virtualhost->virtualhost}}</p>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{$virtualhost->username}}</p>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{$virtualhost->description}}</p>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="m-2 mb-5 text-end">De {{($virtualhosts->currentpage()-1)*$virtualhosts->perpage()+1}} a {{$virtualhosts->currentpage()*$virtualhosts->perpage()}}
                de  {{$virtualhosts->total()}} resultados
            </div>
        @else
            <div class="alert alert-warning mt-3">
                No existen resultados
            </div>
        @endif
    </div>

