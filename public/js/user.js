function save_account_details()
{
    var form = $('form#account-form');
    var data = {
        first_name: form.find('#first_name').val(),
        last_name: form.find('#last_name').val(),
        gender: form.find('#gender:checked').val(),
        department: form.find('#department').val(),
        job_title: form.find('#job_title').val(),
        job_description: form.find('#job_description').val(),
        address: form.find('#address').val(),
        twitter_handle: form.find('#twitter_handle').val(),
        facebook_handle: form.find('#facebook_handle').val(),
        linkedin_handle: form.find('#linkedin_handle').val(),
        google_plus_handle: form.find('#google_plus_handle').val()
    }

    if(!$("form#account-form").valid())
    {
        return false;
    }

    $.doAJAX(base_url + '/user/ajax/save_account_details', { 'data': data }, 'POST', function (response)
    {
        if (response.status == true)
        {
            notify("success", "Your details has been successfully saved!");
        }
        else
        {
            notify("error", response.error_description);
        }
    });
}

function change_password()
{
    var form = $('form#password-form');
    var data = {
        old_password: form.find('#old_password').val(),
        new_password: form.find('#new_password').val(),
        confirm_new_password: form.find('#confirm_new_password').val()
    }

    if(!$("form#password-form").valid())
    {
        return false;
    }

    $.doAJAX(base_url + '/user/ajax/change_password', { 'data': data }, 'PUT', function (response)
    {
        if (response.status == true)
        {
            notify("success", "Your password has been successfully updated!");
        }
        else
        {
            notify("error", response.error_description);
        }
    });
}

function change_email()
{
    var form = $('form#email-form');
    var data = {
        old_email: form.find('#old_email').val(),
        new_email: form.find('#new_email').val(),
        confirm_new_email: form.find('#confirm_new_email').val()
    }

    if(!$("form#email-form").valid())
    {
        return false;
    }

    $.doAJAX(base_url + '/user/ajax/change_email', { 'data': data }, 'PUT', function (response)
    {
        if (response.status == true)
        {
            notify("success", "Your email has been successfully updated!");
        }
        else
        {
            notify("error", response.error_description);
        }
    });
}

function update_availability(obj, id)
{
    var status = ($(obj).attr('checked')) ? 'Not Available' : 'Available';

    $.doAJAX(base_url + '/user/ajax/update_availability', { 'id': id, 'status': status }, 'PUT', function (response)
    {
        if (response.status == true)
        {
            // notify("success", "Your email has been successfully updated!");
            if($(obj).attr('checked'))
            {
                $(obj).removeAttr('checked');
                $('div#avail-' + id).removeClass('bg-success');
                $('div#avail-' + id).addClass('bg-danger');
            }
            else
            {
                $(obj).attr('checked', true);
                $('div#avail-' + id).removeClass('bg-danger');
                $('div#avail-' + id).addClass('bg-success');
            }
        }
        else
        {
            notify("error", response.error_description);
        }
    });
}

function remove_availability(id)
{
    $.doAJAX(base_url + '/user/ajax/remove_availability/' + id, {}, 'DELETE', function (response)
    {
        if (response.status == true)
        {
            // notify("success", "Your availability has been successfully removed!");
            $('div#avail-' + id).closest('.card').fadeOut("slow");
        }
        else
        {
            notify("error", response.error_description);
        }
    });
}

function set_status(obj)
{
    var checked = ($(obj).attr('checked')) ? 0 : 1;
    if(checked)
    {
        $(obj).attr('checked', true);
    }
    else
    {
        $(obj).removeAttr('checked');
    }
}

function show_hide_availability_flags(obj)
{
    var display = ($(obj).attr('checked')) ? 0 : 1;
    if(display)
    {
        $(obj).attr('checked', true);
        $('div#availability_flags').fadeIn('slow');
    }
    else
    {
        $(obj).removeAttr('checked');
        $('div#availability_flags').fadeOut('slow');
    }
}

function save_availability_details()
{
    var form = $('form#availability-form');
    var data = {
        date: form.find('#date').val(),
        duration: (form.find('#duration').attr('checked')) ? 1 : 0,
        from_time: form.find('#from_time').val(),
        to_time: form.find('#to_time').val(),
        status: (form.find('#status').attr('checked')) ? 'Available' : 'Not Available'
    }
    
    if(!form.valid())
    {
        return false;
    }

    $.doAJAX(base_url + '/user/ajax/add_availability', { 'data': data }, 'POST', function (response)
    {
        if (response.status == true)
        {
            // notify("success", "Your email has been successfully updated!");
            $('div#availability-grid').fadeOut().html(response.content).fadeIn();
        }
        else
        {
            notify("error", response.error_description);
        }
    });
}