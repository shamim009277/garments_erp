<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TextTranslateService
{
    protected array $customWords = [
        'Md.'           => 'মোহাম্মদ',
        'Md'            => 'মোহাম্মদ',
        'Mohd'          => 'মোহাম্মদ',
        'Mohammad'      => 'মোহাম্মদ',
        'Muhammad'      => 'মুহাম্মদ',
        'Mst.'          => 'মোছাঃ',
        'Mst'           => 'মোছাঃ',
        'Mosammat'      => 'মোছাঃ',
        'Mrs.'          => 'মিসেস',
        'Mrs'           => 'মিসেস',
        'Mr.'           => 'মিস্টার',
        'Mr'            => 'মিস্টার',
        'Miss'          => 'মিস',
        'Ms.'           => 'মিজ',
        'Dr.'           => 'ডাক্তার',
        'Dr'            => 'ডাক্তার',
        'Prof.'         => 'প্রফেসর',
        'Engr.'         => 'ইঞ্জিনিয়ার',
        'Engineer'      => 'ইঞ্জিনিয়ার',
        'JR.'           => 'জুনিয়র',
        'Jr.'           => 'জুনিয়র',
        'Junior'        => 'জুনিয়র',
        'SR.'           => 'সিনিয়র',
        'Sr.'           => 'সিনিয়র',
        'Senior'        => 'সিনিয়র',
        'Manager'       => 'ম্যানেজার',
        'Director'      => 'ডিরেক্টর',
        'Officer'       => 'অফিসার',
        'Supervisor'    => 'সুপারভাইজার',
        'Assistant'     => 'সহকারী',
        'Executive'     => 'এক্সিকিউটিভ',
        'Coordinator'   => 'কো-অর্ডিনেটর',
        'Administrator' => 'অ্যাডমিনিস্ট্রেটর',
        'Rahaman'       => 'রহমান',
        'Rahman'        => 'রহমান',
        'Hossain'       => 'হোসেন',
        'Hosain'        => 'হোসেন',
        'Islam'         => 'ইসলাম',
        'Ahmed'         => 'আহমেদ',
        'Ahmad'         => 'আহমাদ',
        'Khan'          => 'খান',
        'Uddin'         => 'উদ্দিন',
        'uddin'         => 'উদ্দিন',
        'Ali'           => 'আলী',
        'Begum'         => 'বেগম',
        'Akter'         => 'আক্তার',
        'Sultana'       => 'সুলতানা',
    ];

    protected array $customPhrases = [
        'Md.'  => 'মোহাম্মদ',
        'Md'   => 'মোহাম্মদ',
        'Dr.'  => 'ডা.',
        'Mr.'  => 'মি.',
        'Mrs.' => 'মিসেস',
        'Ms.'  => 'মিস',
    ];

    protected array $skipWords = [
        'id',
        'ID',
        'No',
        'no',
    ];

    /**
     * Translate word by word
     */
    public function translate(?string $text): ?string
    {
        if ($text === null) {
            return null;
        }

        $text = trim($text);

        if ($text === '') {
            return '';
        }

        $words = preg_split('/\s+/', $text);
        $result = [];

        foreach ($words as $word) {

            $clean = trim($word, " \t\n\r\0\x0B,.-");

            if ($clean === '') {
                continue;
            }

            // Skip numbers and fixed words
            if (is_numeric($clean) || in_array($clean, $this->skipWords, true)) {
                $result[] = $clean;
                continue;
            }

            // Custom Dictionary
            if (isset($this->customWords[$clean])) {
                $result[] = $this->customWords[$clean];
                continue;
            }

            // Google Translate
            $result[] = $this->translateViaGoogle($clean);
        }

        return implode(' ', $result);
    }

    /**
     * Translate sentence with custom prefix support
     */
    public function translatePart(?string $sentence): ?string
    {
        if ($sentence === null) {
            return null;
        }

        $sentence = trim($sentence);

        if ($sentence === '') {
            return '';
        }

        $words = preg_split('/\s+/', $sentence);

        $first = trim($words[0], "., ");

        if (isset($this->customPhrases[$first])) {

            $custom = $this->customPhrases[$first];

            $rest = implode(' ', array_slice($words, 1));

            $translatedRest = $this->translate($rest);

            if ($translatedRest === null || $translatedRest === '') {
                return $custom;
            }

            return $custom . ' ' . $translatedRest;
        }

        return $this->translate($sentence);
    }

    /**
     * Google Translate with Cache
     */
    protected function translateViaGoogle(string $word): string
    {
        $cacheKey = 'bn_translate_' . md5($word);
        return Cache::remember($cacheKey, now()->addDays(30), function () use ($word) {
            try {
                $gt = new GoogleTranslate('bn');
                return $gt->translate($word);
            } catch (\Throwable $e) {
                report($e);
                return $word;
            }
        });
    }
}
