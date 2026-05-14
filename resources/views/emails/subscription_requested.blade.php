<!DOCTYPE html>
<html>
<head>
    <title>New Subscription Request</title>
</head>
<body>
    <h2>New Subscription Request Received</h2>
    <p>A user has submitted a new subscription request.</p>
    
    <h3>Details:</h3>
    <ul>
        <li><strong>User Name:</strong> {{ $subscription->user->name }}</li>
        <li><strong>User Email:</strong> {{ $subscription->user->email }}</li>
        <li><strong>Plan:</strong> {{ $subscription->plan->name }} (₹{{ number_format($subscription->plan->price, 2) }})</li>
        <li><strong>Transaction ID:</strong> {{ $subscription->transaction_id }}</li>
        <li><strong>Date Submitted:</strong> {{ $subscription->created_at->format('d M Y, h:i A') }}</li>
    </ul>

    <p>Please log in to the admin panel to review the payment screenshot and approve or reject this request.</p>
    
    <p>
        <a href="{{ url('/admin/subscriptions') }}">View in Admin Panel</a>
    </p>
</body>
</html>
