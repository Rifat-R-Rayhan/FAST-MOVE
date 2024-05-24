@extends('client.layouts.masterlayout')
@section('content')

    <style>

        .accordion-item {
            border-bottom: 1px solid #ccc;
        }
        .toggle-icon {
            float: right;
            margin-right: 10px;
            cursor: pointer;
            font-size: 20px;
        }

        .accordion-title {
            cursor: pointer;
            padding: 10px 0;
        }

        .accordion-content {
            display: none;
            padding: 10px 0;
        }
    </style>

    <div class="container-xxl py-5 bg-danger hero-header mb-5">
        <div class="container my-5 py-5 px-lg-5">
            <div class="row g-5 pt-5">
                <div class="col-12 text-center text-lg-start">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1>Frequently Asked Questions</h1>
        <div class="accordion">
            @foreach ($faqs as $faq)
                <div class="accordion-item">
                    <div class="accordion-title">
                        <span class="toggle-icon">+</span>{{ $faq['question'] }}
                    </div>
                    <div class="accordion-content">
                        <p>{{ $faq['answer'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const accordionItems = document.querySelectorAll('.accordion-item');

        accordionItems.forEach(item => {
            const title = item.querySelector('.accordion-title');
            const toggleIcon = title.querySelector('.toggle-icon');
            const content = item.querySelector('.accordion-content');

            title.addEventListener('click', function() {
                item.classList.toggle('active');
                content.style.display = content.style.display === 'block' ? 'none' : 'block';
                toggleIcon.textContent = item.classList.contains('active') ? '-' : '+';
            });
        });
    });

    </script>
@endsection