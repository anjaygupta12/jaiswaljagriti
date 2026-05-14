<!DOCTYPE html>
<html>
<head>
    <title>Subscription Status Update</title>
</head>
<body>
    <h2>Hello {{ $subscription->user->name }},</h2>
    
    <p>Your subscription for the <strong>{{ $subscription->plan->name }}</strong> plan is currently <strong>{{ strtoupper($subscription->status) }}</strong>.</p>
    
    @if($subscription->status == 'pending')
        <p>We have received your payment details and are currently reviewing them. We will notify you once your subscription is approved.</p>
    @elseif($subscription->status == 'approved')
        <p>Congratulations! Your payment has been verified and your subscription is now active. Thank you for your support.</p>
    @elseif($subscription->status == 'rejected')
        <p>Unfortunately, your subscription request was rejected. This usually happens if the transaction ID was invalid or the payment screenshot could not be verified. Please contact support if you believe this is an error.</p>
    @endif

    <p>Thank you,<br>Jaiswal Jagriti Team</p>
</body>
</html>
