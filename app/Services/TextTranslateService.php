<?php

namespace App\Services;

use Stichoza\GoogleTranslate\GoogleTranslate;

class TextTranslateService
{
    // Custom dictionary (you can extend)
    protected $customWords = [
        'Md.'       => 'মোহাম্মদ',
        'Md'        => 'মোহাম্মদ',
        'JR.'       => 'জুনিয়র',
        'Junior'    => 'জুনিয়র',
        'Manager'   => 'ম্যানেজার',
        'Rahaman'   => 'রহমান',
    ];
    /**
     * Translate a full name or sentence to Bangla.
     *
     * @param string $text
     * @return string
     */
    public function translate(string $text): string
    {
        // Step 1: Split by space
        $words = explode(' ', $text);
        $translatedWords = [];

        foreach ($words as $word) {
            $cleanWord = trim($word, " ,.-");

            // Step 2: If exists in customWords, use custom
            if (array_key_exists($cleanWord, $this->customWords)) {
                $translatedWords[] = $this->customWords[$cleanWord];
            } else {
                // Step 3: Google Translate fallback
                $translatedWords[] = $this->translateViaGoogle($cleanWord);
            }
        }

        // Step 4: Return joined translated sentence
        return implode(' ', $translatedWords);
    }
    // Custom first-part dictionary
    protected $customPhrases = [
        'Md.'       => 'মোহাম্মদ',
        'Md'        => 'মোহাম্মদ',
        'Dr.'       => 'ডা.',
        'Mr.'       => 'মি.',
        'Mrs.'      => 'মিসেস',
        'Ms.'       => 'মিস',
        'Mrs'       => 'মিসেস',
    ];
    /**
     * Translate a sentence based on custom-first match or full Google Translate
     *
     * @param string $sentence
     * @return string
     */
    public function translatePart(string $sentence): string
    {
        $words = explode(' ', $sentence);
        $first = $words[0];

        // Trim punctuation
        $cleanFirst = trim($first, "., ");

        // Step 1: If custom match found at beginning
        if (array_key_exists($cleanFirst, $this->customPhrases)) {
            $customTranslation = $this->customPhrases[$cleanFirst];
            $remaining = implode(' ', array_slice($words, 1));

            // Try to translate remaining via Google Translate
            $translatedRest = $this->translateViaGoogle($remaining);

            return trim($customTranslation . ' ' . $translatedRest);
        }

        // Step 2: Else, translate full sentence via Google
        return $this->translateViaGoogle($sentence);
    }

    /**
     * Use Google Translate to translate word to Bangla.
     */
    protected function translateViaGoogle(string $word): string
    {
        try {
            $gt = new GoogleTranslate('bn');
            return $gt->translate($word);
        } catch (\Exception $e) {
            return $word; // If Google fails, return original
        }
    }
}
