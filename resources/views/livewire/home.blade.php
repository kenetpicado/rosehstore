@section('title', 'Home')

<div>
	<div class="row">
        @foreach ($stock as $user)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    {{ $user->name }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    C$ {{ number_format($user->current_total_cost, 1) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign  fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Inventario total
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            	{{ $current_total_cost }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign  fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Inventario Mobiliario
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            	{{ $fornitures }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign  fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Productos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            	{{ $stock->sum('current_quantity') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tshirt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Ventas {{ date('M') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $sales}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sign-in fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Compras {{ date('M') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $purchases }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sign-out fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
