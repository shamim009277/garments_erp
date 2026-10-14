@php
    $options = $questions->mapWithKeys(fn($item) => [$item->id => $item->question_bn])->toArray();
    $answers = $questions->mapWithKeys(fn($item) => [$item->answer_bn => $item->answer_bn])->toArray();
    $questionAnswerMap = $questions->mapWithKeys(fn($item) => [$item->id => $item->answer_bn])->toArray();
    $saved = $uniqueApplicant->detailsQuality->firstWhere('sl', $key) ?? null;

    $selectedQuestion = $saved->question_id ?? null;
    $selectedAnswer = $saved->answer ?? null;
    $selectedStatus = $saved->status ?? null;
@endphp

<tr>
    <td class="text-center">{{ $key }}</td>

    <td>
        <x-select-input
            name="question_id[{{ $key }}]"
            class="mb-0 question-select2"
            data-row="{{ $key }}"
            :options="$options"
            :selected="$selectedQuestion"
            required
        />
        <input type="hidden" id="map2_{{ $key }}" value='@json($questionAnswerMap)'>
    </td>

    <td>
        <x-select-input
            name="answer_id[{{ $key }}]"
            class="mb-0 answer-select2"
            id="answer2_{{ $key }}"
            :options="$answers"
            :selected="$selectedAnswer"
            required
        />
    </td>

    <td>
        <x-select-input
            name="status[{{ $key }}]"
            class="mb-0"
            :options="['1' => 'Yes', '0' => 'No']"
            :selected="$selectedStatus"
            required
        />
    </td>
</tr>
