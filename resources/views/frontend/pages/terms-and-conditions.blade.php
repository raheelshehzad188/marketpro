@extends('frontend.layouts.master')
@section('title', 'Terms & Conditions')

@section('content')
    <div role="main" class="main shop pb-4">
        <div class="container">
            <!-- Breadcrumb & Page Title -->
            <div class="row margin-50">
                <div class="col-md-12 align-self-center order-1">
                    <ul class="breadcrumb d-block appear-animation animated fadeIn appear-animation-visible">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                    </ul>
                    <h2 class="page-title">TERMS & CONDITIONS</h2>
                </div>
            </div>

            <!-- Terms & Conditions Content -->
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card border-width-3 border-radius-0 border-color-hover-dark">
                        <div class="card-body p-5">
                            @if(!empty($termsContent))
                                <div class="terms-content">
                                    {!! $termsContent !!}
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <p class="mb-0">Terms & Conditions content is being updated. Please check back soon.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
<style>
    .terms-content {
        line-height: 1.8;
        color: #333;
    }
    .terms-content h1, .terms-content h2, .terms-content h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #2c3e50;
    }
    .terms-content p {
        margin-bottom: 1rem;
    }
    .terms-content ul, .terms-content ol {
        margin-bottom: 1rem;
        padding-left: 2rem;
    }
    .terms-content li {
        margin-bottom: 0.5rem;
    }
</style>
@endsection

