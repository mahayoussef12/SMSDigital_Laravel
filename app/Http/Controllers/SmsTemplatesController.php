<?php

namespace App\Http\Controllers;


use App\Models\SmsTemplate;
use Illuminate\Http\Request;

class SmsTemplatesController extends Controller
{
    public function index()
    {
        return SmsTemplate::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|unique:smsTemplate,title',
            'content' => 'required|string|max:160',
        ]);

        $template = SmsTemplate::create($validated);
        return response()->json($template, 201);
    }

    public function show($id)
    {
        return SmsTemplate::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $template = SmsTemplate::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|unique:smsTemplate,title,' . $template->id,
            'content' => 'sometimes|required|string|max:160',
        ]);

        $template->update($validated);
        return response()->json($template);
    }

    public function destroy($id)
    {
        $template = SmsTemplate::findOrFail($id);
        $template->delete();

        return response()->json(['message' => 'Template supprimé']);
    }
}

