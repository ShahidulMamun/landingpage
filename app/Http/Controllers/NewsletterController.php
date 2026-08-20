<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $existing = Subscriber::where('email', $validated['email'])->first();

        if ($existing) {
            if ($existing->status === 'subscribed') {
                return response()->json([
                    'message' => 'এই ইমেইলটা আগে থেকেই সাবস্ক্রাইব করা আছে।',
                    'already' => true,
                ]);
            }

            // আগে unsubscribe করেছিল — আবার সাবস্ক্রাইব করাচ্ছি
            $existing->update([
                'status'           => 'subscribed',
                'subscribed_at'    => now(),
                'unsubscribed_at'  => null,
            ]);

            return response()->json(['message' => 'আবার সাবস্ক্রাইব করা হয়েছে। ধন্যবাদ!']);
        }

        Subscriber::create([
            'email'              => $validated['email'],
            'status'             => 'subscribed',
            'unsubscribe_token'  => Str::random(48),
            'subscribed_at'      => now(),
        ]);

        return response()->json(['message' => 'সাবস্ক্রাইব করার জন্য ধন্যবাদ!']);
    }

    public function unsubscribe(string $token)
    {
        $subscriber = Subscriber::where('unsubscribe_token', $token)->first();

        if (!$subscriber) {
            abort(404);
        }

        if ($subscriber->status === 'subscribed') {
            $subscriber->update([
                'status'           => 'unsubscribed',
                'unsubscribed_at'  => now(),
            ]);
        }

        return view('newsletter.unsubscribed', compact('subscriber'));
    }
}