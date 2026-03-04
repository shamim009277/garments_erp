<div class="row g-3">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-bottom">
                <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Assigned Shipment
                    Schedule
                    {!! $basicorder->order_no !!} | Order Quantity: {{ $basicorder->order_quantity }}</h6>
            </div>
            <div class="card-body">
                <form method="POST"
                    action="{{ route('ordermanagement.database.basicorders.colors_sizes.store', $basicorder->id) }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label">Lot</label>
                            <select class="form-select" name="lot_id" id="lot_id">
                                <option value="">Select Lot</option>
                                @foreach ($basicorder->lots as $lot)
                                <option value="{{ $lot->id }}">{{ $lot->lot_no }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Color</label>
                            <x-select-multiple-input name="color_id[]" multiple 
                                                :options="$colors->pluck('color_name', 'id')" 
                                                :selected="old('color_id')" />
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Size Group</label>
                            <x-select-multiple-input name="size_name[]" multiple 
                                                :options="$sizes->pluck('size_name', 'id')" 
                                                :selected="old('size_name')" />
                        </div>
                        


                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        @include('ordermanagement::database.basicorders.lotcolorsizes')
    </div>
</div>
<!-- <script>
    $(document).ready(function() {
        $('#lot_id').on('change', function() {
            var lotId = $(this).val();
            var colorSelect = $('#color_id');
            var sizeGroupSelect = $('#size_group_id');
            colorSelect.empty().append('<option value="">Select Color</option>');
            sizeGroupSelect.empty().append('<option value="">Select Size Group</option>');

            $.getJSON('/inventory/database/basicorders/lot/' + lotId + '/colors', function(colors) {
                $.each(colors, function(index, color) {
                    colorSelect.append('<option value="' + color.id + '">' + color.color_name + '</option>');
                });
            });
        });

        $('#color_id').on('change', function() {
            var colorId = $(this).val();
            var sizeGroupSelect = $('#size_group_id');
            sizeGroupSelect.empty().append('<option value="">Select Size Group</option>');

            $.getJSON('/inventory/database/basicorders/color/' + colorId + '/sizes', function(sizesgroup) {
                $.each(sizesgroup, function(index, sizegroup) {
                    sizeGroupSelect.append('<option value="' + sizegroup.id + '">' + sizegroup.size_group_name + '</option>');
                });
            });
        });

        $('#size_group_id').on('change', function() {
            var sizeGroupId = $(this).val();
            var sizeContainer = $('#size-container');
            sizeContainer.empty();

            $.getJSON('/inventory/database/basicorders/size_group/' + sizeGroupId + '/sizes', function(sizes) {
                $.each(sizes, function(index, size) {
                    var row = '<tr>' +
                        '<td>' +
                        '<input type="hidden" name="size_ids[]" value="' + size.id + '">' +
                        size.size_name +
                        '</td>' +
                        '<td><input type="text" class="form-control" name="sizes[' + size.id + ']" value="0"></td>' +
                        '</tr>';
                    sizeContainer.append(row);
                });
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#addLots').click(function() {
            var row = `<div class="col-md-12">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Color</label>
                                    <select class="form-select" name="color_id">
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Size</label>
                                    <select class="form-select" name="size_id">
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" class="form-control" name="quantity">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Action</label>
                                    <button type="button" class="btn btn-primary" id="addLots"><i data-feather="plus"
                                            width="14" height="14" class="me-1"></i> Add</button>
                                </div>
                            </div>
                        </div>`;
            $('#addLots').before(row);
        });
    });
</script> -->