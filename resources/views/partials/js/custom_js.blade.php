<script>
    
    $(document).ready(function(){ 
        $('.dropdown-item').change(function(){
            console.log('change');
        });

        $('input[required]').on('invalid', function() {
            this.setCustomValidity("Trường ("+ $(this).parents('.form-group').children('label').text().replace('*', '') + ") là bắt buộc !!");
        });
        $('select[required]').on('invalid', function() {
            this.setCustomValidity("Trường ("+ $(this).parents('.form-group').children('label').text().replace('*', '') + ") là bắt buộc !!");
        });
        $('#student_record_id.select-search.form-control').change(function(){
            console.log($(this).find(':selected').attr('dob')); 
            $('#dob').val($(this).find(':selected').attr('dob'));
            $('#dob').datepicker("setDate", $(this).find(':selected').attr('dob'));
        })
    });

    function getStudentClass(class_id){
        var url = '{{ route('get_class_student', [':id']) }}';
        url = url.replace(':id', class_id);
        var section = $('#student_record_id');

        $.ajax({
            dataType: 'json',
            url: url,
            success: function (resp) {
                console.log(resp);
                section.empty();
                section.append('<option value="0">Chọn học sinh ... </option>');
                $.each(resp, function (i, data) {
                    
                    section.append(
                        $('<option>', {
                            value: data.id,
                            text: data.name,
                            dob: data.dob
                        })
                    );
                });

            }
        })
    }

    function getWritteByDate(date){
        date = date.replaceAll('/','-');
        var url = '{{ route('get_writte_by_day', [':date']) }}';
        url = url.replace(':date', date);
        $.ajax({
            dataType: 'json',
            url: url,
            success: function (resp) {
                console.log(resp);
                $("select#session_time option").removeAttr('disabled');
                $('#session_time').select2();
                if(resp.status == 'success'){
                    flash({msg : resp.flash_success, type : 'success'});
                    // $('.btn.btn-primary').removeClass('disabled');
                }else {
                    flash({msg : resp.flash_warning, type : 'warning'});
                    // $('.btn.btn-primary').addClass('disabled');
                }
                if(resp.fill >0){
                    resp.fills.forEach(function(val){
                        $("select#session_time option[value='"+ val + "']").attr('disabled', 'true');
                        $('#session_time').select2();
                    });
                    
                } 

            }
        })
    }

    function getLGA(state_id){
        var url = '{{ route('get_lga', [':id']) }}';
        url = url.replace(':id', state_id);
        var lga = $('#lga_id');

        $.ajax({
            dataType: 'json',
            url: url,
            success: function (resp) {
                //console.log(resp);
                lga.empty();
                $.each(resp, function (i, data) {
                    lga.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });

            }
        })
    }

    function getClassSections(class_id, destination){
        var url = '{{ route('get_class_sections', [':id']) }}';
        url = url.replace(':id', class_id);
        var section = destination ? $(destination) : $('#section_id');

        $.ajax({
            dataType: 'json',
            url: url,
            success: function (resp) {
                //console.log(resp);
                section.empty();
                $.each(resp, function (i, data) {
                    section.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });

            }
        })
    }

    function getClassSubjects(class_id){
        var url = '{{ route('get_class_subjects', [':id']) }}';
        url = url.replace(':id', class_id);
        var section = $('#section_id');
        var subject = $('#subject_id');

        $.ajax({
            dataType: 'json',
            url: url,
            success: function (resp) {
                console.log(resp);
                section.empty();
                subject.empty();
                $.each(resp.sections, function (i, data) {
                    section.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });
                $.each(resp.subjects, function (i, data) {
                    subject.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });

            }
        })
    }


    {{--Notifications--}}

    @if (session('pop_error'))
    pop({msg : '{{ session('pop_error') }}', type : 'error'});
    @endif

    @if (session('pop_warning'))
    pop({msg : '{{ session('pop_warning') }}', type : 'warning'});
    @endif

    @if (session('pop_success'))
    pop({msg : '{{ session('pop_success') }}', type : 'success', title: 'GREAT!!'});
    @endif

    @if (session('flash_info'))
      flash({msg : '{{ session('flash_info') }}', type : 'info'});
    @endif

    @if (session('flash_success'))
      flash({msg : '{{ session('flash_success') }}', type : 'success'});
    @endif

    @if (session('flash_warning'))
      flash({msg : '{{ session('flash_warning') }}', type : 'warning'});
    @endif

     @if (session('flash_error') || session('flash_danger'))
      flash({msg : '{{ session('flash_error') ?: session('flash_danger') }}', type : 'danger'});
    @endif

    {{--End Notifications--}}

    function pop(data){
        swal({
            title: data.title ? data.title : 'Oops...',
            text: data.msg,
            icon: data.type
        });
    }

    function flash(data){
        new PNotify({
            text: data.msg,
            type: data.type,
            hide : data.type !== "danger"
        });
    }
    function confirmAccept(id) {
        swal({
            title: "Bạn có chắc không?",
            text: "Xác nhận phê duyệt đơn xin phép này!",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then(function(willDelete){console.log(willDelete);
            if (willDelete) {
             $('form#item-accept-'+id+status).submit();
            }
        });
    }
    function confirmDeny(id) {
        swal({
            title: "Bạn có chắc không?",
            text: "Xác nhận từ chối đơn xin phép này!",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then(function(willDelete){
            if (willDelete) {
             $('form#item-deny-'+id).submit();
            }
        });
    }

    function confirmDelete(id) {
        swal({
            title: "Bạn có chắc không?",
            text: "Sau khi xóa, bạn sẽ không thể khôi phục mục này!",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then(function(willDelete){
            if (willDelete) {
             $('form#item-delete-'+id).submit();
            }
        });
    }

    function confirmReset(id) {
        swal({
            title: "Bạn có chắc không?",
            text: "Thao tác này sẽ đặt lại mục này về trạng thái mặc định",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then(function(willDelete){
            if (willDelete) {
             $('form#item-reset-'+id).submit();
            }
        });
    }

    $('form#ajax-reg').on('submit', function(ev){
        ev.preventDefault();
        submitForm($(this), 'store');
        $('#ajax-reg-t-0').get(0).click();
    });

    $('form.ajax-pay').on('submit', function(ev){
        ev.preventDefault();
        submitForm($(this), 'store');

//        Retrieve IDS
        var form_id = $(this).attr('id');
        var td_amt = $('td#amt-'+form_id);
        var td_amt_paid = $('td#amt_paid-'+form_id);
        var td_bal = $('td#bal-'+form_id);
        var input = $('#val-'+form_id);

        // Get Values
        var amt = parseInt(td_amt.data('amount'));
        var amt_paid = parseInt(td_amt_paid.data('amount'));
        var amt_input = parseInt(input.val());

//        Update Values
        amt_paid = amt_paid + amt_input;
        var bal = amt - amt_paid;

        td_bal.text(''+bal);
        td_amt_paid.text(''+amt_paid).data('amount', ''+amt_paid);
        input.attr('max', bal);
        bal < 1 ? $('#'+form_id).fadeOut('slow').remove() : '';
    });

    $('form.ajax-store').on('submit', function(ev){
        ev.preventDefault();
        submitForm($(this), 'store');
        var div = $(this).data('reload');
        div ? reloadDiv(div) : '';
    });

    $('form.ajax-update').on('submit', function(ev){
        ev.preventDefault();
        submitForm($(this));
        var div = $(this).data('reload');
        div ? reloadDiv(div) : '';
    });

    $('.download-receipt').on('click', function(ev){
        ev.preventDefault();
        $.get($(this).attr('href'));
        flash({msg : '{{ 'Download in Progress' }}', type : 'info'});
    });

    function reloadDiv(div){
        var url = window.location.href;
        url = url + ' '+ div;
        $(div).load( url );
    }

    function submitForm(form, formType){
        var btn = form.find('button[type=submit]');
        disableBtn(btn);
        var ajaxOptions = {
            url:form.attr('action'),
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:new FormData(form[0])
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(resp){
            resp.ok && resp.msg
               ? flash({msg:resp.msg, type:'success'})
               : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();
            enableBtn(btn);
            formType == 'store' ? clearForm(form) : '';
            scrollTo('body');
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){
                var errors = e.responseJSON.errors;
                displayAjaxErr(errors);
            }
           if(e.status == 500){
               displayAjaxErr([e.status + ' ' + e.statusText + ' Vui lòng kiểm tra mục nhập trùng lặp hoặc liên hệ với quản trị viên trường học/nhân viên CNTT'])
           }
            if(e.status == 404){
               displayAjaxErr([e.status + ' ' + e.statusText + ' - Không tìm thấy tài nguyên hoặc bản ghi được yêu cầu'])
           }
            enableBtn(btn);
            return e.status;
        });
    }

    function disableBtn(btn){
        var btnText = btn.data('text') ? btn.data('text') : 'Submitting';
        btn.prop('disabled', true).html('<i class="icon-spinner mr-2 spinner"></i>' + btnText);
    }

    function enableBtn(btn){
        var btnText = btn.data('text') ? btn.data('text') : 'Submit Form';
        btn.prop('disabled', false).html(btnText + '<i class="icon-paperplane ml-2"></i>');
    }

    function displayAjaxErr(errors){
        $('#ajax-alert').show().html(' <div class="alert alert-danger border-0 alert-dismissible" id="ajax-msg"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button></div>');
        $.each(errors, function(k, v){
            $('#ajax-msg').append('<span><i class="icon-arrow-right5"></i> '+ v +'</span><br/>');
        });
        scrollTo('body');
    }

    function scrollTo(el){
        $('html, body').animate({
            scrollTop:$(el).offset().top
        }, 2000);
    }

    function hideAjaxAlert(){
        $('#ajax-alert').hide();
    }

    function clearForm(form){
        form.find('.select, .select-search').val([]).select2({ placeholder: 'Chọn ...'});
        form[0].reset();
    }



</script>