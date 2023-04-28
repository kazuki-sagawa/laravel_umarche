<div>
    @if(empty($filename))
        <img src="{{ asset('images/no_image.jpg') }}" >
    @else
        <img src="{{ asser('storage/shops/' . $filename) }}" >
    @endif
</div>