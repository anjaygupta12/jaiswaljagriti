@extends('layouts.app')

@section('title', 'Jaiswal Jagriti Family | Job')

@section('content')

<style>

    .job-section {
        padding: 60px 0;
        background: #f8f9fa;
    }


    .section-title {
         text-align: center!important;
        margin-bottom: 50px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    background-color:white!important;
    padding: 10px 10px 10px 20px;
    margin-bottom: 25px;
}

    .section-title h2 {
        font-size: 42px;
        font-weight: 700;
        color: #000000;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 0;
    }

    .job-card {
        background: #fff;
        border-radius: 18px;
        padding: 30px 20px;
        min-height: 180px;
        position: relative;
        overflow: hidden;
        transition: 0.4s ease;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);

        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .job-card::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #e36108 0%, #e36108 100%);
        opacity: 0;
        transition: 0.4s;
    }

    .job-card:hover::before {
        opacity: 1;
    }

    .job-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }

    .job-card h4 {
        position: relative;
        z-index: 2;
        margin: 0;
        font-size: 22px;
        font-weight: 700;
        line-height: 1.5;
    }

    .job-card h4 a {
        color: #222;
        text-decoration: none;
        transition: 0.4s;
    }

    .job-card:hover h4 a {
        color: #fff;
    }

    /* Category Box */

    .category-box {
        background: #fff;
        border-radius: 18px;
        padding: 25px;
        height: 100%;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: 0.3s;
    }

    .category-box:hover {
        transform: translateY(-5px);
    }

    .category-title {
        margin-bottom: 20px;
    }

    .category-title h3 {
        font-size: 28px;
        font-weight: 700;
        color: #e36108;
        margin-bottom: 0;
    }

    .category-title a {
        text-decoration: none;
        color: #e36108;
    }

    .job-list {
        padding-left: 18px;
        margin-bottom: 25px;
    }

    .job-list li {
        margin-bottom: 12px;
    }

    .job-list li a {
        color: #222;
        text-decoration: none;
        transition: 0.3s;
        line-height: 1.6;
    }

    .job-list li a:hover {
        color: #e36108;
        padding-left: 5px;
    }

    .job-btn {
        background: linear-gradient(135deg, #e36108 0%, #e36108 100%);
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: 0.3s;
    }

    .job-btn:hover {
        color: #fff;
        transform: scale(1.05);
    }

    @media(max-width:991px){

        .section-title h2{
            font-size: 34px;
        }

        .job-card{
            min-height: 150px;
        }

        .job-card h4{
            font-size: 20px;
        }
    }

    @media(max-width:767px){

        .job-section{
            padding: 40px 0;
        }

        .section-title h2{
            font-size: 28px;
        }

        .job-card{
            min-height: 130px;
            padding: 20px;
        }

        .job-card h4{
            font-size: 18px;
        }

        .category-title h3{
            font-size: 24px;
        }
    }
</style>

<section class="job-section">

    <div class="container">

        <!-- Title -->
        <div class="section-title">
            <h2>Jobs</h2>
        </div>

        <!-- Top Cards -->
        <div class="row g-4 mb-5">
            @forelse($featuredJobs as $fJob)
                <div class="col-lg-3 col-md-6">
                    <div class="job-card">
                        <h4>
                            <a href="{{ $fJob->link ?: '#' }}" {{ $fJob->link ? 'target="_blank"' : '' }}>
                                {{ $fJob->title }}
                            </a>
                        </h4>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">No featured jobs at the moment.</div>
            @endforelse
        </div>

        <!-- Categories -->
        <div class="row g-4">
            @foreach($categories as $category)
                <div class="col-lg-4">
                    <div class="category-box">

                        <div class="category-title">
                            <h3>
                                <a href="#">{{ $category->name }}</a>
                            </h3>
                        </div>

                        <ul class="job-list">
                            @forelse($category->listings as $job)
                                <li>
                                    <a href="{{ $job->link ?: '#' }}" {{ $job->link ? 'target="_blank"' : '' }}>
                                        {{ $job->title }}
                                    </a>
                                </li>
                            @empty
                                <li class="text-muted small">No jobs in this category.</li>
                            @endforelse
                        </ul>

                        <a href="#" class="job-btn">
                            More Jobs
                        </a>

                    </div>
                </div>
            @endforeach
        </div>

    </div>

</section>

@endsection
