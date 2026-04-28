<div class="square-switch">
    <input
        type="checkbox"
        id="square-switch{{ $id }}"
        class="group-toggle"
        data-id="{{ $dataId }}"
        switch="bool"
        {{ $checked ? 'checked' : '' }}
    />

    <label
        for="square-switch{{ $id }}"
        data-on-label="Yes"
        data-off-label="No"
        style="margin: 0px; vertical-align: middle;"
    ></label>
</div>
