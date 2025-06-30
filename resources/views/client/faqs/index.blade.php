@extends('layout.client')

@section('content')
    <section class="section-banner">
        <div class="row banner-image">
            <div class="banner-overlay"></div>
            <div class="banner-section">
                <div class="lh-banner-contain">
                    <h2>FAQ</h2>
                    <div class="lh-breadcrumb">
                        <h5>
                            <span class="lh-inner-breadcrumb">
                                <a href="{{ url('/') }}">Trang chủ</a>
                            </span>
                            <span> / </span>
                            <span>
                                <a href="javascript:void(0)">FAQ</a>
                            </span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-5">
<h2 class="mb-4 text-center fw-bold text-dark">Câu hỏi thường gặp</h2>

        {{-- Danh sách câu hỏi --}}
        @if($faqs->isEmpty())
            <p>Chưa có câu hỏi nào được đăng.</p>
        @else
            <div class="accordion" id="faqAccordion">
                @foreach ($faqs as $faq)
                    <div class="accordion-item mb-2">
                        <h2 class="accordion-header" id="heading{{ $faq->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false"
                                    aria-controls="collapse{{ $faq->id }}">
                                <span class="me-2 fw-bold">Câu hỏi:</span> {{ $faq->question }}
                            </button>
                        </h2>
                        <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse"
                             aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p><strong>Câu trả lời:</strong></p>
                                @if ($faq->answer)
                                    {!! nl2br(e($faq->answer)) !!}
                                @else
                                    <em class="text-muted">Đang chờ phản hồi từ quản trị viên.</em>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Form đặt câu hỏi --}}
        <div class="mt-5">
            <h4 class="mb-3">Bạn có câu hỏi? Hãy gửi cho chúng tôi:</h4>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('client.faqs.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="question" class="form-label">Câu hỏi của bạn</label>
                    <textarea name="question" id="question" class="form-control" rows="3" required>{{ old('question') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Gửi câu hỏi</button>
            </form>
        </div>
    </div>
@endsection
