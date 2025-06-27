<?php

namespace App\Http\Controllers;

use App\Models\contacts;
use App\Models\SmsLog;
use App\Models\SmsTemplate;
use App\Services\SmsService;
use Illuminate\Http\Request;

class SmsLogsController extends Controller
{
    public function test(SmsService $sms)
    {
        $status = $sms->send('+21642350030', 'Bonjour depuis Laravel avec Twilio !');

        return response()->json([
            'status' => $status === true ? 'Envoyé' : 'Erreur',
            'message' => $status === true ? null : $status
        ]);

    }
    public function send(Request $request, SmsService $sms)
    {
        $request->validate([
            'contact_id' => 'required|exists:contacts,id',
            'template_id' => 'required|exists:sms_templates,id',
        ]);

        $contact = contacts::findOrFail($request->contact_id);
        $template = SmsTemplate::findOrFail($request->template_id);

        // ✅ Envoi réel avec Twilio
        $result = $sms->send($contact->phone, $template->content);

        $status = $result === true ? 'SENT' : 'FAILED';

        // ✅ Journaliser l'envoi
        $log = SmsLog::create([
            'contact_id' => $contact->id,
            'sms_template_id' => $template->id,
            'status' => $status,
            'response' => $result === true ? 'SMS envoyé' : $result,
        ]);

        return response()->json([
            'status' => $status,
            'contact' => $contact->phone,
            'message' => $template->content,
            'log' => $log,
        ]);
    }

}
