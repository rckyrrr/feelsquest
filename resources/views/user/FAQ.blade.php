@extends('template.Home_Template')

@section('konten')
    <div class="container my-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">FAQ</h1>
        </div>
        @foreach ($faq as $f)
            <div class="accordion accordion-flush shadow p-3 mb-5 bg-white rounded" id="accord1">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#isi{{ $f->id }}" aria-expanded="false"
                            aria-controls="isi{{ $f->id }}">
                            {{ $f->question }}
                        </button>
                    </h2>
                    <div id="isi{{ $f->id }}" class="accordion-collapse collapse"
                        data-bs-parent="#accord{{ $f->id }}">
                        <div class="accordion-body">{{ $f->answer }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
