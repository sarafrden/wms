

@php
if ($quantity <= '5') {
    $class = 'red';
} else {
    $class = 'green';
}
@endphp


<p class="badge" style="background:{{ $class }}; margin-bottom: 0rem; color:black;" >{!! $quantity !!}</p>

<style>
    .green {
        color: #11d668 !important;
    }

    .red {
        color: red !important;
    }

    .yellow {
        color: #f5f500 !important;
    }

</style>
