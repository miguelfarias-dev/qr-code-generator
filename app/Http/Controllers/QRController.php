<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QRService;

class QRController extends Controller
{
    private $qrService;

    public function __construct(QRService $qrService)
    {
        $this->qrService = $qrService;
    }

    public function index(Request $request)
    {
        $qr = null;

        if (!$request->text) {
            session()->flash('error', 'Please enter some text to generate a QR code.');
            return view('qr.index', compact('qr'));
        }

        $qr = $this->qrService->generate($request->text, 'svg');

        return view('qr.index', compact('qr'));
    }

    public function api(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:1000',
            'format' => 'in:svg,png'
        ]);

        $text = $request->text;

        if (empty(trim($text))) {
            return response()->json(['error' => 'Text is required'], 400);
        }

        $format = $request->format ?? 'svg';
        $size = (int) $request->input('size', 300);
        $margin = (int) $request->input('margin', 4);

        // validación simple
        $size = max(100, min(1000, $size));
        $margin = max(0, min(20, $margin));

        $qr = $this->qrService->generate($text, $format, $size, $margin);

        $contentType = $format === 'png' ? 'image/png' : 'image/svg+xml';

        return response($qr)
            ->header('Content-Type', $contentType);
    }

    public function download(Request $request)
    {
        $text = $request->input('text');

        if (!$text) {
            return redirect('/');
        }

        $format = $request->input('format', 'svg');
        $size = (int) $request->input('size', 300);
        $margin = (int) $request->input('margin', 4);

        // validación simple
        $size = max(100, min(1000, $size));
        $margin = max(0, min(20, $margin));

        $qr = $this->qrService->generate($text, $format, $size, $margin);

        $contentType = $format === 'png'
            ? 'image/png'
            : 'image/svg+xml';

        $extension = $format === 'png'
            ? 'png'
            : 'svg';

        return response($qr, 200, [
            'Content-Type' => $contentType,
            'Content-Disposition' => "attachment; filename=\"qr.$extension\"",
        ]);
    }
}
