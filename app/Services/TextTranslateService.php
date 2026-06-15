<?php

namespace App\Services;

use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Cache;

// class TextTranslateService
// {
//     // Custom dictionary (you can extend)
//     protected $customWords = [
//         'Md.'       => 'মোহাম্মদ',
//         'Md'        => 'মোহাম্মদ',
//         'JR.'       => 'জুনিয়র',
//         'Junior'    => 'জুনিয়র',
//         'Manager'   => 'ম্যানেজার',
//         'Rahaman'   => 'রহমান',
//     ];
//     /**
//      * Translate a full name or sentence to Bangla.
//      *
//      * @param string $text
//      * @return string
//      */
//     public function translate(string $text): string
//     {
//         // Step 1: Split by space
//         $words = explode(' ', $text);
//         $translatedWords = [];

//         foreach ($words as $word) {
//             $cleanWord = trim($word, " ,.-");

//             // Step 2: If exists in customWords, use custom
//             if (array_key_exists($cleanWord, $this->customWords)) {
//                 $translatedWords[] = $this->customWords[$cleanWord];
//             } else {
//                 // Step 3: Google Translate fallback
//                 $translatedWords[] = $this->translateViaGoogle($cleanWord);
//             }
//         }

//         // Step 4: Return joined translated sentence
//         return implode(' ', $translatedWords);
//     }
//     // Custom first-part dictionary
//     protected $customPhrases = [
//         'Md.'       => 'মোহাম্মদ',
//         'Md'        => 'মোহাম্মদ',
//         'Dr.'       => 'ডা.',
//         'Mr.'       => 'মি.',
//         'Mrs.'      => 'মিসেস',
//         'Ms.'       => 'মিস',
//         'Mrs'       => 'মিসেস',
//     ];
//     /**
//      * Translate a sentence based on custom-first match or full Google Translate
//      *
//      * @param string $sentence
//      * @return string
//      */
//     public function translatePart(string $sentence): string
//     {
//         $words = explode(' ', $sentence);
//         $first = $words[0];

//         // Trim punctuation
//         $cleanFirst = trim($first, "., ");

//         // Step 1: If custom match found at beginning
//         if (array_key_exists($cleanFirst, $this->customPhrases)) {
//             $customTranslation = $this->customPhrases[$cleanFirst];
//             $remaining = implode(' ', array_slice($words, 1));

//             // Try to translate remaining via Google Translate
//             $translatedRest = $this->translateViaGoogle($remaining);

//             return trim($customTranslation . ' ' . $translatedRest);
//         }

//         // Step 2: Else, translate full sentence via Google
//         return $this->translateViaGoogle($sentence);
//     }

//     /**
//      * Use Google Translate to translate word to Bangla.
//      */
//     protected function translateViaGoogle(string $word): string
//     {
//         try {
//             $gt = new GoogleTranslate('bn');
//             return $gt->translate($word);
//         } catch (\Exception $e) {
//             return $word;
//         }
//     }
// }

class TextTranslateService
{
    protected array $customWords = [
        'Md.'          => 'মোহাম্মদ',
        'Md'           => 'মোহাম্মদ',
        'Mohd'         => 'মোহাম্মদ',
        'Mohammad'     => 'মোহাম্মদ',
        'Muhammad'     => 'মুহাম্মদ',
        'Mst.'         => 'মোছাঃ',
        'Mst'          => 'মোছাঃ',
        'Mosammat'     => 'মোছাঃ',
        'Mrs.'         => 'মিসেস',
        'Mrs'          => 'মিসেস',
        'Mr.'          => 'মিস্টার',
        'Mr'           => 'মিস্টার',
        'Miss'         => 'মিস',
        'Ms.'          => 'মিজ',
        'Dr.'          => 'ডাক্তার',
        'Dr'           => 'ডাক্তার',
        'Prof.'        => 'প্রফেসর',
        'Engr.'        => 'ইঞ্জিনিয়ার',
        'Engineer'     => 'ইঞ্জিনিয়ার',
        'JR.'          => 'জুনিয়র',
        'Jr.'          => 'জুনিয়র',
        'Junior'       => 'জুনিয়র',
        'SR.'          => 'সিনিয়র',
        'Sr.'          => 'সিনিয়র',
        'Senior'       => 'সিনিয়র',
        'Manager'      => 'ম্যানেজার',
        'Director'     => 'ডিরেক্টর',
        'Officer'      => 'অফিসার',
        'Supervisor'   => 'সুপারভাইজার',
        'Assistant'    => 'সহকারী',
        'Executive'    => 'এক্সিকিউটিভ',
        'Coordinator'  => 'কো-অর্ডিনেটর',
        'Administrator'=> 'অ্যাডমিনিস্ট্রেটর',
        'Rahaman'      => 'রহমান',
        'Rahman'       => 'রহমান',
        'Hossain'      => 'হোসেন',
        'Hosain'       => 'হোসেন',
        'Islam'        => 'ইসলাম',
        'Ahmed'        => 'আহমেদ',
        'Ahmad'        => 'আহমাদ',
        'Khan'         => 'খান',
        'Uddin'        => 'উদ্দিন',
        'uddin'        => 'উদ্দিন',
        'Ali'          => 'আলী',
        'Begum'        => 'বেগম',
        'Akter'        => 'আক্তার',
        'Sultana'      => 'সুলতানা',
    ];

    protected array $customPhrases = [
        'Md.' => 'মোহাম্মদ',
        'Md' => 'মোহাম্মদ',
        'Dr.' => 'ডা.',
        'Mr.' => 'মি.',
        'Mrs.' => 'মিসেস',
        'Ms.' => 'মিস',
    ];

    // words never translate (IDs, numbers, codes)
    protected $skipWords = [
        'id', 'ID', 'No', 'no'
    ];

    /**
     * MAIN TRANSLATE (word by word)
     */
    public function translate(string $text): string
    {
        if (empty($text)) return '';

        $words = explode(' ', $text);
        $result = [];

        foreach ($words as $word) {
            $clean = trim($word, " ,.-");
            // skip numeric or ids
            if (is_numeric($clean) || in_array($clean, $this->skipWords)) {
                $result[] = $clean;
                continue;
            }

            // custom dictionary
            if (isset($this->customWords[$clean])) {
                $result[] = $this->customWords[$clean];
                continue;
            }

            // cached google translate
            $result[] = $this->translateViaGoogle($clean);
        }

        return implode(' ', $result);
    }

    /**
     * SMART SENTENCE TRANSLATE
     */
    public function translatePart(string $sentence): string
    {
        if (empty($sentence)) return '';

        $words = explode(' ', $sentence);
        $first = trim($words[0], "., ");

        if (isset($this->customPhrases[$first])) {
            $custom = $this->customPhrases[$first];
            $rest = implode(' ', array_slice($words, 1));
            return trim($custom . ' ' . $this->translate($rest));
        }

        return $this->translate($sentence);
    }

    /**
     * GOOGLE TRANSLATE WITH CACHE
     */
    protected function translateViaGoogle(string $word): string
    {
        $cacheKey = 'bn_translate_' . md5($word);
        return Cache::remember($cacheKey, 60 * 60 * 24, function () use ($word) {
            try {
                $gt = new GoogleTranslate('bn');
                return $gt->translate($word);
            } catch (\Exception $e) {
                return $word;
            }
        });
    }
}
