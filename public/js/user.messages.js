function get_message_content(section)
{
    $.doAJAX(base_url + '/user/ajax/get_message_content/' + section, {}, 'GET', function (response)
    {
        if (response.status == true)
        {
            $('#messages-tab').find('.nav-link').removeClass('active');
            $('#messages-tab').find('.' + section).addClass('active');

            $('div#message-content-holder').fadeOut().html(response.content).fadeIn();
        }
        else
        {
            notify("error", response.error_description);
        }
    });
}

function send_message()
{
    var form = $('form#compose-form');
    var data = {
        recipient: form.find('#recipient').val(),
        subject: form.find('#subject').val(),
        message: form.find('#message').val()
    }

    $.doAJAX(base_url + '/user/ajax/send_message', { 'data': data }, 'POST', function (response)
    {
        if (response.status == true)
        {
            notify("success", "Your message has been successfully sent!");
        }
        else
        {
            notify("error", response.error_description);
        }
    });
}

function get_message_history(id)
{
    $.doAJAX(base_url + '/user/ajax/get_message_history/' + id, {}, 'GET', function (response)
    {
        if (response.status == true)
        {
            $('div.au-chat').fadeOut().html(response.content).fadeIn();

            $('.au-inbox-wrap').addClass('show-chat-box');
        }
        else
        {
            notify("error", response.error_description);
        }
    });
}

function send_reply_message(sender_id, message_id, subject)
{
    var form = $('form#reply-form');
    var data = {
        recipient: sender_id,
        message_id: message_id,
        subject: subject,
        message: form.find('#message').val()
    }

    $.doAJAX(base_url + '/user/ajax/send_message', { 'data': data }, 'POST', function (response)
    {
        if (response.status == true)
        {
            notify("success", "Your message has been successfully sent!");
        }
        else
        {
            notify("error", response.error_description);
        }
    });
}