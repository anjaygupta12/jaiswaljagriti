<section class="magazine-section">
    <div class="container-custom">
        <div class="section-title"><h2>Jaiswal Jagriti Magazine</h2></div>
        <div class="magazine-wrapper">
            <div class="magazine-left">
                <img src="{{ asset('images/Screenshot-2025-07-09-171638.png') }}" alt="Magazine Cover">
                <div class="content">
                    <h3>Jaiswal Jagriti Quarterly Magazine</h3>
                    <p style="margin: 15px 0; line-height: 1.6;">It was only natural that to give shape to our objectives, we needed a mouthpiece. Hence, in April 1994, the quarterly magazine titled 'Jaiswal Jagriti' was launched at a grand cultural event held in the air-conditioned hall of the National Museum in Delhi. Since then, this magazine has been published regularly. Today, while many magazines are ceasing publication, 'Jaiswal Jagriti' continues to gain popularity and move forward with a sense of social responsibility and awareness.</p>
                    <a href="" class="btn-primary">Subscribe Now</a>
                </div>
            </div>
            <div class="magazine-right">
                <div class="news-ticker-wrapper">
                    <div class="news-ticker">
                        @foreach($magazines ?? [] as $magazine)
                        <div class="news-item">
                            <a href="{{ asset($magazine['pdf_path']) }}" target="_blank">📘 {{ $magazine['title'] }}</a>
                            <div class="news-meta">Magazine · {{ $magazine['date'] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="subscription-plans">
                    <h4><i class="fas fa-tags"></i> Subscription Plans</h4>
                    @foreach($subscriptionPlans ?? [] as $plan)
                    <div class="plan-item">
                        <span><strong>{{ $plan['name'] }}</strong></span>
                        <span>{{ $plan['price'] }}</span>
                        <a href="{{ route('subscribe', ['plan' => $plan['id']]) }}" class="btn-outline" style="padding: 5px 15px; font-size: 12px;">Select</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
