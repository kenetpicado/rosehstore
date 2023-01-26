@props(['title' => 'All'])

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-borderless align-middle" width="100%" cellspacing="0" id="no-more-tables">
                <thead>
                    <tr>
                        {{ $header }}
                    </tr>
                </thead>
                <tbody>
                    {{ $slot }}
                </tbody>
            </table>
        </div>
        @isset($links)
            {{ $links }}
        @endisset
    </div>
</div>
