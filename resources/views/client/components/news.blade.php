@php
    use App\Models\Admin;
    use App\Models\News;
    use Illuminate\Support\Facades\Session;

    $admin = [];
    if (Session::has('loginId')) {
        $admin = Admin::where('id', '=', Session::get('loginId'))->first();
    }
    $news = News::latest()->get();
@endphp

<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-9 wow fadeInUp" data-wow-delay="0.1s">
                @foreach($news as $article)
                    <div class="news-item">
                        <div class="section-title position-relative mb-4 pb-4">
                            <h1 class="mb-2">{{ __('text.content72') }}</h1>
                        </div>
                        <h2>{{ $article->title }}</h2>
                        {{-- @if($article->news_image)
                            <img src="{{ asset('admins/news_images') }}/{{ $article->news_image }}"
                                                alt="News photo" class="img-fluid">
                        @endif --}}
                        <p>{{ $article->content }}</p>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="news-item">
                        <button class="btn btn-info"><a class="btn btn-outline-light btn-social" href=""><i
                            class="fab fa-youtube"></i> See More</a></button>
                    </div>
            </div>
        </div>
    </div>
</div>