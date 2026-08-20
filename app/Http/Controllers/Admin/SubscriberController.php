<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        $query = Subscriber::query()->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $query->where('email', 'like', '%' . $request->q . '%');
        }

        $subscribers = $query->paginate(20)->withQueryString();

        $counts = [
            'all'          => Subscriber::count(),
            'subscribed'   => Subscriber::where('status', 'subscribed')->count(),
            'unsubscribed' => Subscriber::where('status', 'unsubscribed')->count(),
        ];

        return view('admin.subscribers.index', compact('subscribers', 'counts'));
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();
        return back()->with('status', 'সাবস্ক্রাইবার ডিলিট হয়েছে');
    }

    public function export(Request $request): StreamedResponse
    {
        $query = Subscriber::query()->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $filename = 'subscribers-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        return response()->streamDownload(function () use ($query) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Email', 'Status', 'Subscribed At', 'Unsubscribed At']);

            $query->chunk(200, function ($chunk) use ($handle) {
                foreach ($chunk as $s) {
                    fputcsv($handle, [
                        $s->email,
                        $s->status,
                        optional($s->subscribed_at)->format('Y-m-d H:i'),
                        optional($s->unsubscribed_at)->format('Y-m-d H:i'),
                    ]);
                }
            });

            fclose($handle);
        }, $filename, $headers);
    }
}