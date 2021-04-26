$(document).ready(function(){
    // Hide at the starting of flow
    $("#new-workflow").hide();
    $(".message_form").hide();
    $(".call_form").hide();
    $(".appointment_form").hide();

    // Show when new workflow is created
    $("#show").click(function(){
      $("#new-workflow").show();
    });

    $("#message").click(function(){
        $(".appointment_form").hide();
        $(".message_form").show();
        $(".call_form").hide();
    });

    $("#call").click(function(){
        $(".appointment_form").hide();
        $(".message_form").hide();
        $(".call_form").show();
    });

    $("#appointment").click(function(){
        $(".appointment_form").show();
        $(".message_form").hide();
        $(".call_form").hide();
    });

    // Hide when new workflow is cancelled
    $("#hide").click(function(){
        $("#new-workflow").hide();
    });


    // add row
    $("#addRow").click(function () {
        var html = '';

        html += '<div class="row" id="dynamic_message_form" style="margin-top: 20px;">';
        html +=    '<div class="col">';
        html +=        '<input type="number" class="form-control" name="message_from[]" id="message_from" placeholder="From"/>';
        html +=    '</div>';
        html +=    '<div class="col">';
        html +=        '<input type="number" class="form-control" name="message_to[]" id="message_to" placeholder="To"/>';
        html +=    '</div>';
        html +=    '<div class="col">';
        html +=        '<input type="date" class="form-control" name="message_date[]" id="message_date" placeholder="From"/>';
        html +=    '</div>';
        html +=    '<div class="col">';
        html +=        '<select name="mode[]" class="form-control">';
        html +=              '<option value="sent">Sent</option>';
        html +=              '<option value="recieved">Recieved</option>';
        html +=        '</select>';
        html +=    '</div>';
        html +=    '<div class="col button-group">';
        html +=        '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
        html +=    '</div>';
        html +='</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#dynamic_message_form').remove();
    });


    // add row
    $("#addRow1").click(function () {
        var html = '';

        html += '<div class="row" id="dynamic_call_form" style="margin-top: 20px;">';
        html +=    '<div class="col">';
        html +=        '<input type="number" class="form-control" name="call_from[]" id="call_from" placeholder="From"/>';
        html +=    '</div>';
        html +=    '<div class="col">';
        html +=        '<input type="number" class="form-control" name="call_to[]" id="call_to" placeholder="To"/>';
        html +=    '</div>';
        html +=    '<div class="col">';
        html +=        '<input type="date" class="form-control" name="call_date[]" id="call_date" placeholder="Date"/>';
        html +=    '</div>';
        html +=    '<div class="col">';
        html +=        '<select name="mode[]" class="form-control">';
        html +=              '<option value="made">Made</option>';
        html +=              '<option value="recieved">Recieved</option>';
        html +=        '</select>';
        html +=    '</div>';
        html +=    '<div class="col">';
        html +=        '<input type="time" class="form-control" name="call_duration[]" id="call_duration" placeholder="Call Duration"/>';
        html +=    '</div>';
        html +=    '<div class="col button-group">';
        html +=        '<button id="removeRow1" type="button" class="btn btn-danger">Remove</button>';
        html +=    '</div>';
        html +='</div>';

        $('#newRow1').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow1', function () {
        $(this).closest('#dynamic_call_form').remove();
    });

    // add row
    $("#addRow2").click(function () {
        var html = '';

        html += '<div class="row" id="dynamic_appointment_form" style="margin-top: 20px;">';
        html +=    '<div class="col">';
        html +=        '<input type="date" class="form-control" name="appointment_date[]" id="appointment_date" placeholder="Date"/>';
        html +=    '</div>';
        html +=    '<div class="col">';
        html +=        '<input type="email" class="form-control" name="email[]" id="email" placeholder="Email"/>';
        html +=    '</div>';
        html +=    '<div class="col button-group">';
        html +=        '<button id="removeRow2" type="button" class="btn btn-danger">Remove</button>';
        html +=    '</div>';
        html +='</div>';

        $('#newRow2').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow2', function () {
        $(this).closest('#dynamic_appointment_form').remove();
    });

});


