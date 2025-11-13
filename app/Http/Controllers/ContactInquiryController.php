<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactInquiry;

class ContactInquiryController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'nullable|string|max:20',
            'country' => 'required|string|max:255',
            'arrivalDate' => 'nullable|date',
            'departureDate' => 'nullable|date',
            'message' => 'nullable|string|max:2000',
        ]);

        try {
            // Send email
            Mail::to(env('CONTACT_EMAIL', 'info@embarkceylon.com'))
                ->send(new ContactInquiry($validated));

            return response()->json([
                'success' => true,
                'message' => 'Inquiry sent successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send inquiry: ' . $e->getMessage()
            ], 500);
        }
    }
}