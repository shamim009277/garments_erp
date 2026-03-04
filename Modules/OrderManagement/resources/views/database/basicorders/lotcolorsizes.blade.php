 @section('styles')
 <style>
     .table,
     tr,
     th,
     td {
         border: none !important;
         border-collapse: collapse;
     }
 </style>
 @endsection
 @php
 $lots = collect($lotColorsSizes)->unique('lot_id');
 @endphp
 @foreach($lots as $lot)
 @php
 $Colors = collect($lotColorsSizes)->where('lot_id', $lot->lot_id)->unique('color_id');
 $colorText = $Colors->pluck('color_name')->implode(', ');
 @endphp
 <div class="card border-0 shadow-sm">
     <div class="card-header bg-transparent border-bottom">
         <h6 class="my-0 text-primary">
             LOT : {!! $lot->lot_no !!} | Colors : ({{ $colorText }})</h6>
     </div>
     <div class="card-body">
         <div class="row">
             @foreach($Colors as $color)
             @php
             $sizes = collect($lotColorsSizes)->where('lot_id', $lot->lot_id)->where('color_id', $color->color_id);
             @endphp

             <div class="col-md-6">
                 <h6 class="my-0 text-primary">
                     Color : {{ $color->color_name }}</h6>
                 <table class="table table-bordered">
                     <thead>
                         <tr>
                             <th>Size</th>
                             <th>Quantity(PCS )</th>
                             <th>Remarks</th>
                             <th>Actiona</th>
                         </tr>
                     </thead>
                     <tbody id="size-container">
                         @foreach($sizes as $size)
                         <tr>
                             <td>{{ $size->size_name }}</td>
                             <td>
                                 <x-input-group name="qty" class="form-control form-control-sm m-0 p-" :value="$size->qty" id="qty-{{ $size->id }}" required />
                             </td>
                             <td>
                                 <x-input-group name="remarks" class="form-control form-control-sm" :value="$size->size_remarks" id="remarks-{{ $size->id }}" required />
                             </td>
                             <td>
                                 <a href="#" class="btn btn-sm btn-soft-success" onclick='updateSize("{{ $size->id }}")'><i class="fas fa-edit"></i></a>

                                 <a class="btn btn-sm btn-soft-danger"><i class="fas fa-trash"></i></a>
                             </td>
                         </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>

             @endforeach
         </div>

     </div>
 </div>
 @endforeach
 <script>
    function updateSize(sizeId) {
        var qty = $('#qty-' + sizeId).val();
        var remarks = $('#remarks-' + sizeId).val();
        // Add AJAX call to update size
        console.log(qty, remarks);
        $.ajax({
            url: '/ordermanagement/database/basicorders/lotcolorsizes/update/' + sizeId,
            method: 'POST',
            data: {
                qty: qty,
                remarks: remarks,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.success
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.error
                    });
                }
            }
        });
    }
 </script>
