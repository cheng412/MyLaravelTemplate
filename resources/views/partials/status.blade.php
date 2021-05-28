@switch($status)
    @case('active')
        <span class="badge badge-success">{!! ucfirst($status) !!}</span>
        @break
    @case('inactive')
        <span class="badge badge-danger">{!! ucfirst($status) !!}</span>
        @break
    @case('unverified')
        <span class="badge badge-warning">{!! ucfirst($status) !!}</span>
        @break
    @default
        <span class="badge badge-default">{!! ucfirst($status) !!}</span>
@endswitch