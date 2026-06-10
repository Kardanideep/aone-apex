<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $generalTerms = Setting::where('key', 'general_terms')->first();
        $financialTerms = Setting::where('key', 'financial_operational_terms')->first();

        // Strip HTML tags for the plain text editor
        $generalTermsPlain = $this->htmlToPlainText($generalTerms->value ?? '');
        $financialTermsPlain = $this->htmlToPlainText($financialTerms->value ?? '');

        return view('admin.settings.index', compact(
            'generalTerms',
            'financialTerms',
            'generalTermsPlain',
            'financialTermsPlain'
        ));
    }

    public function update(Request $request)
    {
        $field = $request->input('field');

        if ($field === 'general_terms') {
            $request->validate(['general_terms' => 'nullable|string']);
            $plainText = $request->input('general_terms', '');
            $html = $this->plainTextToHtml($plainText, 'purple');
            Setting::updateOrCreate(
                ['key' => 'general_terms'],
                ['value' => $html]
            );
        } elseif ($field === 'financial_operational_terms') {
            $request->validate(['financial_operational_terms' => 'nullable|string']);
            $plainText = $request->input('financial_operational_terms', '');
            $html = $this->plainTextToHtml($plainText, 'pink');
            Setting::updateOrCreate(
                ['key' => 'financial_operational_terms'],
                ['value' => $html]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }

    /**
     * Convert HTML content to plain text (one line per bullet point).
     */
    private function htmlToPlainText(string $html): string
    {
        if (empty($html)) {
            return '';
        }

        // Extract text from <span> tags that contain the actual content (skip bullet icons)
        // Pattern: find <span> tags that contain real text (not just ✦ or bullet chars)
        $lines = [];

        // Try to extract from <li> elements first
        if (preg_match_all('/<li[^>]*>(.*?)<\/li>/si', $html, $matches)) {
            foreach ($matches[1] as $liContent) {
                // Get all span texts, skip the bullet icon spans
                $text = strip_tags($liContent);
                // Remove bullet characters like ✦, •, etc.
                $text = preg_replace('/^[\s✦•●◆►▸\-\*]+/', '', $text);
                $text = trim($text);
                if (!empty($text)) {
                    $lines[] = $text;
                }
            }
        } else {
            // Fallback: just strip all tags
            $text = strip_tags($html);
            $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
            $lines = array_filter(array_map('trim', explode("\n", $text)));
        }

        return implode("\n", $lines);
    }

    /**
     * Convert plain text lines to styled HTML bullet list for the business plan page.
     */
    private function plainTextToHtml(string $plainText, string $color = 'purple'): string
    {
        if (empty(trim($plainText))) {
            return '';
        }

        $lines = array_filter(array_map('trim', explode("\n", $plainText)));

        if (empty($lines)) {
            return '';
        }

        $html = '<ul class="space-y-4 text-gray-400 font-light text-sm relative z-10">' . "\n";

        foreach ($lines as $line) {
            $escapedLine = e($line);
            $html .= '    <li class="flex items-start gap-3">' . "\n";
            $html .= '        <span class="text-brand-' . $color . ' mt-0.5 flex-shrink-0">✦</span>' . "\n";
            $html .= '        <span>' . $escapedLine . '</span>' . "\n";
            $html .= '    </li>' . "\n";
        }

        $html .= '</ul>';

        return $html;
    }
}
