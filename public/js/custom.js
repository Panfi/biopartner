jQuery.extend({
    doAJAX: function (url, data, type, callback)
    {
        if (type.toLowerCase() != "get")
        {
            data["_token"] = _token;
        }
        
        type = !(type) ? "GET" : type;

        //loading('start');

        var object = {
            type: type,
            url: url,
            data: data,
            // dataType: "json",
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                if(XMLHttpRequest.responseJSON)
                {
                    notify('error', XMLHttpRequest.responseJSON.error.message);
                }
                else
                {
                    notify('error',"Error Code: " + XMLHttpRequest.status + " : " + XMLHttpRequest.statusText);
                }

                //loading('stop');
            },
            success: function (data)
            {
                //loading('stop');
                callback(data);
            }
        };

        if(type == 'MULTIPART')
        {
            object.type = 'POST';
            object.data = data.params;
            object.contentType = false;
            object.processData = false;
        }

        return $.ajax(object);

    }
});

function notify(type, msg, title, time_out)
{
    time_out = (time_out == undefined) ? 0 : time_out;

    toastr.options = {
        "closeButton": true,
        "closeHtml": "<i class='glyphicon glyphicon-remove-sign'></i>",
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 1000,
        "timeOut": time_out,
        "extendedTimeOut": 0,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    toastr[type](msg, title);
}