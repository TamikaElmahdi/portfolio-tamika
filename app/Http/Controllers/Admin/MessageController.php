<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Inertia\Inertia;

class MessageController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Message/Index', [
            'messages' => Message::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function show(Message $message)
    {
        if (!$message->read_at) {
            $message->update(['read_at' => now()]);
        }
        return Inertia::render('Admin/Message/Show', ['message' => $message]);
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message supprimé!');
    }
}
