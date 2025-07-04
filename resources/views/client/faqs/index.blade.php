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

    <section class="section-faq padding-tb-100">
        <div class="container">
            <div class="banner" data-aos="fade-up" data-aos-duration="1500">
<h2>Frequently Asked <span style="color: #FF6B00;">Questions</span></h2>            </div>
            <div class="ld-faq" data-aos="fade-up" data-aos-duration="2000">
                <div class="row">
                    <div class="col-lg-6 rs-pb-24">
                        @if($faqs->isEmpty())
                            <div class="text-center py-4">
                                <p class="text-muted">Chưa có câu hỏi nào được đăng.</p>
                            </div>
                        @else
                            <div class="accordion" id="faqAccordion">
                                @foreach ($faqs as $index => $faq)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $index }}">
                                            <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }} shadow-none" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                                {{ $faq->question }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}"
                                            data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                @if ($faq->answer)
                                                    <p>{!! nl2br(e($faq->answer)) !!}</p>
                                                @else
                                                    <p class="text-muted">Đang chờ phản hồi từ quản trị viên.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6 rs-pb-24">
                        <div class="lh-faq-image">
                            <img src="{{ asset('themes/client/assets/img/faq/faq-side.jpg') }}" alt="faq-side-image" class="img-fluid rounded">
                        </div>

                        <div class="mt-5 faq-form bg-light p-4 rounded">
<h4 class="mb-4 fw-bold" style="color: #000000;">Bạn có câu hỏi? Hãy gửi cho chúng tôi:</h4>
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
                                    <label for="question" class="form-label fw-bold">Câu hỏi của bạn</label>
                                    <textarea name="question" id="question" class="form-control" rows="4" required>{{ old('question') }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">Gửi câu hỏi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .section-faq {
            background-color: #f8f9fa;
        }
        
        .banner h2 {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 50px;
            color: #333;
        }
        
        .banner h2 span {
            color: #0d6efd;
        }
        
        .accordion-item {
            margin-bottom: 15px;
            border-radius: 8px !important;
            overflow: hidden;
            border: 1px solid #e0e0e0 !important;
        }
        
        .accordion-button {
            font-weight: 600;
            background-color: #f8f9fa;
            color: #333;
        }
        
        .accordion-button:not(.collapsed) {
            background-color: #f8f9fa;
            color: #0d6efd;
        }
        
        .accordion-button:focus {
            box-shadow: none;
            border-color: #e0e0e0;
        }
        
        .lh-faq-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .faq-form {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .padding-tb-100 {
            padding-top: 100px;
            padding-bottom: 100px;
        }
        
        .rs-pb-24 {
            padding-bottom: 24px;
        }
    </style>
@endsection