<div class="row">
    <div class="col-lg-12">
        <div class="sufee-alert alert with-close alert-primary alert-dismissible fade show text-center">
            <span class="badge badge-pill badge-primary">Tip:</span>
            Use the grid below shows block times according to your availability for meetings.<br>
            Click Update Changes button above to save your changes.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <div class="col-lg-12">
        <i>
            <span class="text-danger pull-right">Not Available</span>
            <span class="text-success pull-right mr-2">Available</span>
        </i>
    </div>

    @if(!empty($availability))
    @foreach($availability as $avail)
        @php
            $id = $avail->id;
            $date = $avail->check_date;
            $from_time = $avail->from_time;
            $to_time = $avail->to_time;
            $status = $avail->status;
            $bg_class = ($status == 'Available') ? 'bg-success' : 'bg-danger';
            $checked = ($status == 'Available') ? 'checked="checked"' : '';
            $title = empty($from_time) ? "All Day" : "$from_time - $to_time";
        @endphp

        <div class="col-lg-3">
            <div class="card">
                <div class="card-header text-white {!! $bg_class !!}" id="avail-{!! $id !!}">
                    <i class="fa fa-clock-o"></i> {!! $date !!} {!! $title !!} <a class="float-right text-white" href="#" onclick="remove_availability('{!! $id !!}')"><i class="fa fa-remove mt-1"></i></a>
                </div>
                <div class="card-body text-center text-info">
                    <span>Not Availability</span>
                    <label class="switch switch-3d switch-success mx-2">
                        <input type="checkbox" class="switch-input" {!! $checked !!} onchange="update_availability(this, '{!! $id !!}')">
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </label>
                    <span>Availability</span>
                </div>
            </div>
        </div>
    @endforeach
    @endif

</div>