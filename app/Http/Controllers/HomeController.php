<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Event;
use App\Models\JobListing;
use App\Models\JobCategory;

class HomeController extends Controller
{

    public function index()
    {
        $plans = Plan::where('status', 1)->latest()->take(5)->get();
        $banners = \App\Models\Banner::where('is_active', true)->latest()->get();
        $magazines = \App\Models\Magazine::where('is_active', true)->latest()->take(10)->get();
        return view('home', compact('plans', 'banners', 'magazines'));
    }
    public function about()
    {
        return view('about');
    }
    public function job()
    {
        $featuredJobs = \App\Models\JobListing::where('status', true)->where('is_featured', true)->latest()->take(4)->get();
        $categories = \App\Models\JobCategory::where('status', true)->with(['listings' => function($q) {
            $q->where('status', true)->latest()->take(10);
        }])->get();

        return view('job', compact('featuredJobs', 'categories'));
    }
        public function YouthWing()
    {
        return view('Youth_wing');
    }
  public function ExecutiveBody()
    {
        return view('executive_body');
    }
      public function womensWing()
    {
        return view('womens_wing');
    }
    public function upcommingEvents(Request $request)
    {
        $query = Event::where('is_active', true);
        
        if ($request->has('category')) {
            $query->whereHas('eventCategory', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $events = $query->latest()->get();
        return view('upcomming_events', compact('events'));
    }

    public function upcommingEventsDeatils(Event $event)
    {
        $event->increment('views');
        $related = Event::where('id', '!=', $event->id)->latest()->take(3)->get();
        $relatedMagazines = $event->relatedMagazines()->where('magazines.is_active', true)->get();
        if ($relatedMagazines->isEmpty()) {
            $relatedMagazines = \App\Models\Magazine::where('is_active', true)->latest()->take(6)->get();
        }
        
        $comments = $event->comments()->where('is_approved', true)->latest()->get();

        return view('upcomming_events_details', compact('event', 'related', 'relatedMagazines', 'comments'));
    }

    public function storeComment(Request $request, $type, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'content' => 'required|string',
        ]);

        $model = $type === 'event' ? Event::findOrFail($id) : null;
        if (!$model) abort(404);

        $model->comments()->create([
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
            'is_approved' => false, // Require approval
        ]);

        return back()->with('success', 'Your comment has been submitted and is awaiting approval.');
    }

    public function patrikaSubscription()
    {
        $plans = Plan::where('status', 1)->where('type', 'patrika')->latest()->get();
        $title = 'Patrika Subscriptions';

        $userSubscriptions = collect();
        if (auth()->check()) {
            $userSubscriptions = auth()->user()->subscriptions()
                ->whereIn('status', ['pending', 'approved'])
                ->get()
                ->keyBy('plan_id');
        }

        return view('subscriptions', compact('plans', 'userSubscriptions', 'title'));
    }

    public function advertisementSubscription()
    {
        $plans = Plan::where('status', 1)->where('type', 'advertisement')->latest()->get();
        $title = 'Advertisement Subscriptions';

        $userSubscriptions = collect();
        if (auth()->check()) {
            $userSubscriptions = auth()->user()->subscriptions()
                ->whereIn('status', ['pending', 'approved'])
                ->get()
                ->keyBy('plan_id');
        }

        return view('subscriptions', compact('plans', 'userSubscriptions', 'title'));
    }
}
