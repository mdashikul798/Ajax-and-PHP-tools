$(document).ready(function() {
    //Fatching data from database
    $('#show_student').on('click', function(e) {
        $.ajax({
            url: 'functions/showData.php',
            type: 'POST',
            success: function(data) {
                console.data;
                $('#table-data').html(data);
            }
        });
    });
    //End of Fatching data from database

    //Insert data to the database page
    // First loading data
    function loadTable() {
        $.ajax({
            url: 'functions/showData.php',
            type: 'POST',
            success: function(data) {
                $('#insert-table-data').html(data);
            }
        });
    }
    loadTable();

    //Inserting student
    $('#add-asudent').on('click', function(e) {
        e.preventDefault();
        var name = $('#student_name').val();
        var age = $('#age').val();

        $.ajax({
            url: 'functions/insertData.php',
            type: 'POST',
            data: { st_name: name, st_age: age },
            success: function(data) {
                if (data == 1) {
                    loadTable();
                    $('#form-data').trigger('reset');
                } else {
                    alert('Data not saved');
                }
            }
        });
    });
    //End of Insert data to the database page

    //Delete item
    $(document).on('click', '#delete-item', function() {
        if (confirm('Do you realy want to delete record permanantly ?')) {
            var studentId = $(this).data('id');
            var elements = this;

            $.ajax({
                url: 'functions/deleteId.php',
                type: 'POST',
                data: { id: studentId },
                success: function(data) {
                    if (data == 1) {
                        $(elements).closest("tr").fadeOut();
                    } else {
                        $('#error-msg').html('Record deleted successfully').slideDown();
                        console.log('Data not deleted');
                    }
                }
            });
        }
    });
    //End of delete item

    //Show edit modal box
    $(document).on('click', '#edit-item', function() {
        $('#modal').show();
        var studentId = $(this).data('eid');
        $.ajax({
            url: 'functions/uploadModelData.php',
            type: 'POST',
            data: { id: studentId },
            success: function(data) {
                $('#modal-form table').html(data);
            }
        });
    });

    //Hide edit modal box
    $('.close-btn').on('click', function() {
        $('#modal').hide();
    });

    //Save update-data
    $(document).on('click', '#update-data', function() {
        var id = $('#updateId').val();
        var student_name = $('#st_name').val();
        var age = $('#st_age').val();
        $.ajax({
            url: 'functions/updateModel.php',
            type: 'POST',
            data: { id: id, student_name: student_name, age: age },
            success: function(data) {
                if (data == 1) {
                    $('#modal').hide();
                    loadTable();
                } else {
                    console.log(Response);
                }
            }
        });
    });

    //Live search
    $('#search_data').on('keyup', function() {
        var search_term = $(this).val();
        $.ajax({
            url: 'functions/liveSearch.php',
            type: 'POST',
            data: { search: search_term },
            success: function(data) {
                $('#insert-table-data').html(data);
            }
        });
    });
    //End of live search

    //Pagination
    function loadPageData(page) {
        $.ajax({
            url: 'functions/pagination.php',
            type: 'POST',
            data: { page_no: page },
            success: function(data) {
                $('#page-data').html(data);
            }
        });
    }
    loadPageData();

    $(document).on('click', '#pagination a', function(e) {
        e.preventDefault;
        var page_id = $(this).attr('id');
        loadPageData(page_id);
    });
    //End of pagination



});

//Select Box data load
$(document).ready(function() {
    $.ajax({
        url: 'functions/selectBox.php',
        type: 'POST',
        dataType: 'JSON',
        success: function(data) {
            $.each(data, function(key, value) {
                $('#select_city').append("<option value='" + value.city + "'>" + value.city + "</option>");
            });
        }
    });

    //Load data
    $('#select_city').change(function() {
        var city = $(this).val();
        if (city == '') {
            $('#selected-data').html('');
        } else {
            $.ajax({
                url: 'functions/selectBoxData.php',
                type: 'POST',
                data: { city: city },
                success: function(data) {
                    $('#selected-data').html(data);
                }
            });
        }
    });
});