@props(['images', 'post'])

{{-- optiona image content --}}
@if ($images)
    @switch(count($images))
        @case(1)
            <a {{ request()->routeIs('post') ? '' : 'href=' . getLocaleURL('/posts/' . $post->id) }} class="d-flex justify-content-center mx-auto mt-2 bg-body-secondary">
                <img src="{{ asset($images[0]) }}" alt="Post Image"
                     class="img-fluid" style="max-height: 32rem;">
            </a>
            @break
        @default
            <div id="{{'images-' . $post->id}}" class="carousel slide mt-2">
                <div class="carousel-inner">
                    @foreach($images as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <a {{ request()->routeIs('post') ? '' : 'href=' . getLocaleURL('/posts/' . $post->id) }} class="container text-center d-flex justify-content-center align-items-center p-0" style="height: 450px;">
                                <img src="{{ asset($image) }}" style="object-fit: contain; max-width: 100%" alt="Post Image">
                            </a>
                        </div>
                    @endforeach

                    <button class="carousel-control-prev" type="button" data-bs-target="#{{'images-' . $post->id}}" data-bs-slide="prev" style="width: 2.5rem">
                        <span class="fs-5 rounded-circle bg-dark position-relative" aria-hidden="true" style="width: 32px; height: 32px">
                            <i class="bi bi-chevron-left position-absolute top-50 start-50 translate-middle"></i>
                        </span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#{{'images-' . $post->id}}" data-bs-slide="next" style="width: 2.5rem">
                        <span class="fs-5 rounded-circle bg-dark position-relative" aria-hidden="true" style="width: 32px; height: 32px">
                            <i class="bi bi-chevron-right position-absolute top-50 start-50 translate-middle"></i>
                        </span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            @break
    @endswitch
@endif
