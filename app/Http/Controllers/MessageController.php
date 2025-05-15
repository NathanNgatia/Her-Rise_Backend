<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;

class MessageController extends Controller
{
    public function store(Request $request, $mentorId)
{
    $request->validate([
        'message' => 'required|string',
    ]);

    $message = Message::create([
        'student_id' => auth()->id(),
        'mentor_id' => $mentorId,
        'content' => $request->message,
    ]);

    return response()->json(['message' => 'Message sent successfully', 'data' => $message], 201);
}

public function getMentorMessages()
{
    $mentorRole = auth()->user();

    if ($mentorRole->role !== 'mentor') {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $messages = Message::where('mentor_id', $mentorRole->id)->with('student')->latest()->get();

    return response()->json(['messages' => $messages]);
}

}
