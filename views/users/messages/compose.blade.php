@php($recipients = array_pluck(Msg::recipients(), 'email', 'id'))

<div class="tab-pane fade show active" id="compose">
{!! Form::open(['id' => 'compose-form']) !!}
    <div class="card no-top-border">
        <div class="card-body mt-4">
            <div class="row">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="recipient" class="form-control-label">Recipient</label>
                        {!! Form::select('recipient', $recipients, '', ['class' => 'form-control', 'id' => 'recipient']) !!}
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="subject" class="form-control-label">Subject</label>
                        <input type="text" id="subject" name="subject" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="message" class="form-control-label">Body</label>
                <textarea id="message" name="message" class="form-control" rows="10"></textarea>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <button type="button" class="btn btn-outline-secondary btn-block" onclick="send_message()">
                        <i class="fa fa-check"></i> Send
                    </button>
                </div>
            </div>
        </div>
    </div>
 {!! Form::close() !!}
</div>

<script type="text/javascript">
    $("form#compose-form").validate({
        onkeyup: false,
        rules: {
            subject: { required: true},
            message: { required: true},
        },
        tooltip_options: {
            subject: { placement: 'top' },
            message: { placement: 'top' },
        }
    });
</script>