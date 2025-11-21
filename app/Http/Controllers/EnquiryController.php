<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TourEnquiry;

class EnquiryController extends Controller
{
    public function send(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:255',
            'contactNumber' => 'required|string|max:20',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'subject' => 'nullable|string|max:500',
            'message' => 'nullable|string|max:2000',
            'tripName' => 'required|string|max:255',
        ]);

        try {
            // Send email
            Mail::to(env('CONTACT_EMAIL', 'info@embarkceylon.com'))
                ->send(new TourEnquiry($validated));

            return response()->json([
                'success' => true,
                'message' => 'Tour enquiry sent successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send enquiry: ' . $e->getMessage()
            ], 500);
        }
    }
}