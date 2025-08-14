<div class="row g-3">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-bottom">
                <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Assigned Shipment Schedule
                    {!! $basicorder->order_no !!}</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('inventory.database.basicorders.lots-colors-sizes.store', $basicorder->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="text-primary">Order Lots ( {!! $basicorder->order_quantity !!})</h3>
                        </div>
                        <div class="col-lg-12">
                            <div id="lots-container">
                                <div class="lot" data-lot-index="0">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <x-input-group name="lots[0][lot_no]" label="Lot No" placeholder="Enter lot no"
                                                :value="old('lots.0.lot_no')" required />
                                        </div>
                                        <div class="col-lg-4">
                                            <h4>Colors</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="colors-container">
                                                <div class="color" data-color-index="0">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <x-select-input-group name="lots[0][colors][0][color_name]"
                                                                label="Color Name" placeholder="Enter color name"
                                                                :options="$colors->pluck('color_name', 'id')" :selected="old('lots.0.colors.0.color_name')" required />
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <h5>Sizes</h5>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="sizes-container">
                                                                <div class="size" data-size-index="0">
                                                                    <div class="row">
                                                                        <div class="col-lg-4">
                                                                            <x-select-input-group
                                                                                name="lots[0][colors][0][sizes][0][size_name]"
                                                                                label="Size Name" placeholder="Enter size name"
                                                                                :options="$sizes->pluck('size_name', 'id')" :selected="old(
                                                                                    'lots.0.colors.0.sizes.0.size_name',
                                                                                )" required />
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <x-input-group
                                                                                name="lots[0][colors][0][sizes][0][quantity]"
                                                                                label="Quantity" placeholder="Enter quantity"
                                                                                :value="old(
                                                                                    'lots.0.colors.0.sizes.0.quantity',
                                                                                )" required />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="button"
                                                                class="btn btn-primary btn-sm mt-2 add-size-btn">Add
                                                                Size</button>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary btn-sm mt-2 add-color-btn">Add
                                                        Color</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary btn-sm mt-2" id="add-lot-btn">Add Lot</button>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary float-end me-2">Submit Order</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let lotIndex = 0;

    document.getElementById('add-lot-btn').addEventListener('click', function() {
        lotIndex++;
        let lotsContainer = document.getElementById('lots-container');

        let lotHtml = `
        <div class="lot" data-lot-index="${lotIndex}">
            <div class="row">
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-4">
                            <x-input-group name="lots[${lotIndex}][lot_no]" label="Lot No" placeholder="Enter lot no"
                                :value="old('lots.${lotIndex}.lot_no')" required />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4>Colors</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="colors-container">
                        <div class="color" data-color-index="0">
                            <div class="row">
                                <div class="col-lg-4">
                                    <x-select-input-group name="lots[${lotIndex}][colors][0][color_name]"
                                        label="Color Name" placeholder="Enter color name"
                                        :options="$colors->pluck('color_name', 'id')"
                                        :value="old('lots.${lotIndex}.colors.0.color_name')" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Sizes</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="sizes-container">
                                        <div class="size" data-size-index="0">
                                            <div class="row">
                                                <x-select-input-group name="lots[${lotIndex}][colors][0][sizes][0][size_name]"
                                                                label="Size Name" placeholder="Enter size name"
                                                                :options="$sizes->pluck('size_name', 'id')"
                                                                :value="old('lots.${lotIndex}.colors.0.sizes.0.size_name')" required />
                                                <x-input-group name="lots[${lotIndex}][colors][0][sizes][0][quantity]"
                                                                label="Quantity" placeholder="Enter quantity"
                                                                :value="old('lots.${lotIndex}.colors.0.sizes.0.quantity')" required />
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm mt-2 add-size-btn">Add Size</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        lotsContainer.insertAdjacentHTML('beforeend', lotHtml);
    });

    // Delegate event listeners for add color and add size buttons
    document.getElementById('lots-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('add-color-btn')) {
            let lotDiv = e.target.closest('.lot');
            let lotIdx = lotDiv.getAttribute('data-lot-index');

            let colorsContainer = lotDiv.querySelector('.colors-container');
            let colorCount = colorsContainer.querySelectorAll('.color').length;
            let colorHtml = `
            <div class="color" data-color-index="${colorCount}">
                <div class="row">
                    <div class="col-lg-4">
                        <x-select-input-group name="lots[${lotIdx}][colors][${colorCount}][color_name]"
                                                                label="Color Name" placeholder="Enter color name" :options="$colors->pluck('color_name', 'id')"
                                                                :value="old('lots.${lotIdx}.colors.${colorCount}.color_name')" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h5>Sizes</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sizes-container">
                            <div class="size" data-size-index="0">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <x-select-input-group name="lots[${lotIdx}][colors][${colorCount}][sizes][0][size_name]"
                                                                label="Size Name" placeholder="Enter size name"
                                                                :options="$sizes->pluck('size_name', 'id')"
                                                                :value="old('lots.${lotIdx}.colors.${colorCount}.sizes.0.size_name')" required />
                                    </div>
                                    <div class="col-lg-4">
                                        <x-input-group name="lots[${lotIdx}][colors][${colorCount}][sizes][0][quantity]"
                                                                label="Quantity" placeholder="Enter quantity"
                                                                :value="old('lots.${lotIdx}.colors.${colorCount}.sizes.0.quantity')" required />
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm mt-2 add-size-btn">Add Size</button>
                    </div>
                </div>
            </div>
            `;
            colorsContainer.insertAdjacentHTML('beforeend', colorHtml);
        }

        if (e.target.classList.contains('add-size-btn')) {
            let colorDiv = e.target.closest('.color');
            let lotDiv = e.target.closest('.lot');
            let lotIdx = lotDiv.getAttribute('data-lot-index');
            let colorIdx = colorDiv.getAttribute('data-color-index');

            let sizesContainer = colorDiv.querySelector('.sizes-container');
            let sizeCount = sizesContainer.querySelectorAll('.size').length;
            let sizeHtml = `
            <div class="size" data-size-index="${sizeCount}">
                <div class="row">
                    <div class="col-lg-4">
                    <x-select-input-group name="lots[${lotIdx}][colors][${colorIdx}][sizes][${sizeCount}][size_name]"
                                                                label="Size Name" placeholder="Enter size name" 
                                                                :options="$sizes->pluck('size_name', 'id')"
                                                                :value="old('lots.${lotIdx}.colors.${colorIdx}.sizes.${sizeCount}.size_name')" required />
                    </div>
                    <div class="col-lg-4">
                    <x-input-group name="lots[${lotIdx}][colors][${colorIdx}][sizes][${sizeCount}][quantity]"
                                                                label="Quantity" placeholder="Enter quantity"
                                                                :value="old('lots.${lotIdx}.colors.${colorIdx}.sizes.${sizeCount}.quantity')" required />
                    </div>
            </div>
            `;

            sizesContainer.insertAdjacentHTML('beforeend', sizeHtml);
        }
    });
</script>
