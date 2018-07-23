@extends('biopartnering::layouts.dashboard_layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body card-block">
                <ul class="nav nav-tabs" id="messages-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link compose" href="javascript:;" onclick="get_message_content('compose')">Compose</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link inbox active" href="javascript:;" onclick="get_message_content('inbox')">Inbox</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sent" href="javascript:;" onclick="get_message_content('sent')">Sent Items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link trash" href="javascript:;" onclick="get_message_content('trash')">Trash</a>
                    </li>
                </ul>
                <div class="tab-content" id="message-content-holder">
                    @include("biopartnering::users.messages.inbox")
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    {!! Html::script(url('vendor/biopartnering/js/user.messages.js')) !!}
@endpush