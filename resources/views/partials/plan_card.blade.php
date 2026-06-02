<div class="col-lg-4 col-md-6 mb-4">
    <div class="card shadow-sm border-0 h-100" style="border-radius: 20px; overflow: hidden; transition: transform 0.3s ease; border: 1px solid #eaeaea !important;">
        <div class="card-header bg-white text-center border-0 pt-4 pb-0">
            <h4 class="font-weight-bold text-dark">{{ $plan->name }}</h4>
            <h2 class="font-weight-bold" style="color: #F80136;">
                ₹{{ number_format($plan->price, 0) }}<span class="text-muted" style="font-size: 16px;">/{{ ucfirst($plan->billing_cycle) }}</span>
            </h2>
            @if($plan->description)
                <p class="text-muted small mt-2">{{ $plan->description }}</p>
            @endif
        </div>
        <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
                @if(is_array($plan->features) && count($plan->features) > 0)
                    @foreach($plan->features as $feature)
                        <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> {{ $feature }}</li>
                    @endforeach
                @else
                    <li class="mb-2 text-muted text-center">No specific features listed.</li>
                @endif
            </ul>
        </div>
        <div class="card-footer bg-white border-0 text-center pb-4">
            @if(auth()->check() && isset($userSubscriptions) && $userSubscriptions->has($plan->id))
                @php $subStatus = $userSubscriptions->get($plan->id)->status; @endphp
                @if($subStatus == 'approved')
                    <button class="btn btn-success btn-block rounded-pill" style="padding: 12px 24px; cursor: not-allowed;" disabled>
                        <i class="fas fa-check-circle"></i> Subscribed
                    </button>
                @elseif($subStatus == 'pending')
                    <button class="btn btn-warning btn-block rounded-pill text-white" style="padding: 12px 24px; cursor: not-allowed;" disabled>
                        <i class="fas fa-clock"></i> Approval Pending
                    </button>
                @endif
            @elseif(auth()->check() && isset($highestSubscribedPrice) && $highestSubscribedPrice >= $plan->price)
                <button class="btn btn-success btn-block rounded-pill" style="padding: 12px 24px; cursor: not-allowed;" disabled>
                    <i class="fas fa-check-circle"></i> Subscribed
                </button>
            @else
                <a href="{{ route('subscribe', $plan->id) }}" class="btn btn-primary btn-block rounded-pill" style="padding: 12px 24px;">
                    Subscribe Now
                </a>
            @endif
        </div>
    </div>
</div>
