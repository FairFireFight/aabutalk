@props(['images', 'post'])

{{-- optiona image content --}}
@if ($images)
    @switch(count($images))
        @case(1)
            <div class="d-flex justify-content-center mx-auto mt-2 bg-body-secondary">
                <img src="{{ asset($images[0]) }}" alt="Post Image"
                     class="img-fluid" style="max-height: 32rem;">
            </div>
            @break
        @default
            <div id="post-images" class="carousel slide mt-2">
                <div class="carousel-inner">
                    <!-- generated html goes in here-->
                    @foreach($images as $index => $image)

                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="container text-center d-flex justify-content-center align-items-center" style="height: 450px;">
                                <img src="{{ asset($image) }}" style="object-fit: contain; max-width: 100%" alt="Post Image">
                            </div>
                        </div>

                    @endforeach


                    <button class="carousel-control-prev" type="button" data-bs-target="#post-images" data-bs-slide="prev">
                        <span class="fs-1" aria-hidden="true"> &lt; </span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#post-images" data-bs-slide="next">
                        <span class="fs-1" aria-hidden="true"> &gt; </span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            @break
    @endswitch
@endif
