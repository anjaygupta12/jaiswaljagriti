<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

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
        return view('job');
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
          public function events()
    {
        return view('events');
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
