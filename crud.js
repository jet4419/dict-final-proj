function InsertUpdateRow(){
    var isAdd = $('#isAdd').val();
    if(isAdd=='true'){
        addNewRow();
        //console.log("addnewrow")
    }
    else {
        updateRow();
        //console.log("updaterow")
    }
}

function showModal(isAdd){
$('#isAdd').val(true);
$('#exampleModalLabel').html("Insert New Record");
clearAll();
$('#addModal').modal('show');
}

function addNewRow(){
    
    var stud_name = $('#student-name').val()
    var stud_add = $('#student-address').val()
    var stud_sex = $('#student-sex').val()
    
    //console.log(stud_name)
    //console.log(stud_add)
    //console.log(stud_sex)

    insertData(stud_name, stud_add, stud_sex);

    clearAll();

    $('#addModal').modal('hide');
}

function updateRow(){

    var student_name = $('#student-name').val()
    var student_address = $('#student-address').val()
    var student_sex = $('#student-sex').val()
    var student_id = $('#student-no').val()

    updateData(student_name, student_address, student_sex, student_id);

    clearAll();

    $('#addModal').modal('hide');
}

function updateData(student_name, student_address, student_sex, student_id){

    $.ajax({
        url: './php/updateData.php',
        method: "POST",
        data: {
            "student_name": student_name,
            "student_address": student_address,
            "student_sex": student_sex,
            "student_id": student_id
        },
        dataType: "json",
        success: function(success){
            //console.log(student_id)
            if(success !=""){
                getData();
            }
        }
    });
}

function addCourse(student_id){
    $('#addClassModal').modal('show');
    $('#student_id').val(student_id);

}

function insertClass(){
    var student_id = $('#student_id').val()
    var course_name = $('#course_name').val()
    var training_fee = $('#training_fee').val()
    console.log(student_id)
    console.log(course_name)
    console.log(training_fee)

    $.ajax(
        {
            url: './php/insertCourse.php',
            method: "POST",
            data: {
                "course_name": course_name,
                "training_fee": training_fee,
                "student_id": student_id
            }, 
            dataType: "json",
            success:function(success){
                console.log(success)
            }
        }
    ); 
}


function editData(student_id){
    $.ajax({
        url: './php/getDataByID.php',
        method: "GET",
        data: {
            "student_id": student_id
        },
        dataType: "json",
        success: function(response){

            $.each(response, function(key,value){
                $('#student-name').val(value.student_name);
                $('#student-address').val(value.student_address);
                $('student-sex').find('option:contains('+ value.student_sex +')').attr('selected','selected');
                $('#student-no').val(value.student_id);
                $('#isAdd').val(false);
                $('#save').html('Update');
                $('#addModal').modal('show');
            });

        }
    });
}

function insertData(student_name, student_address, student_sex){

    $.ajax(
        {
            url: './php/insertData.php',
            method: "POST",
            data: {
                "student_name": student_name,
                "student_address": student_address,
                "student_sex":student_sex
            }, 
            dataType: "json",
            success:function(student_id){
                //console.log(student_id)
                if(student_id != ""){
                    addNewRecordHTML(student_id, student_name, student_address, student_sex);
                }
            }
        }
    );
}

function clearAll(){
    $('#student-no').val('')
    $('#student-name').val('')
    $('#student-address').val('')
    $('#student-sex').prop("selectedIndex",0);
}

function addNewRecordHTML(student_id, student_name, student_address, student_sex){
    var newRow = '<tr>'+
                ' <td>'+ student_id +'</td>'+
                ' <td>'+ student_name +'</td>'+ 
                '<td>'+ student_address +'</td> '+ 
                '<td>'+ student_sex +' </td>'+ 
                '<td><button class="btn btn-info" onClick="addCourse(' + student_id + ')">Add Course</button></td>'+
                '<td><button class="btn btn-primary" onClick="editData(' + student_id + ')">Edit</button></td>'+
                '<td><button class="btn btn-danger" onClick="deleteData(' + student_id + ')">Delete</button></td>'
                '</tr>';

var tableBody = $('#student_data tbody')
tableBody.append(newRow)
}

function deleteData(student_id){

    var response = confirm("Do you want to delete this record?"+ student_id +": Are you sure?");

    if(response){
        $.ajax({
            url:'./php/deleteData.php',
            method: "POST",
            data: {
                "student_id": student_id
            },
            dataType: "json",
            success: function(success){
                if (success != ""){
                    getData();
                }
            }
        });
    }
}

function getData(){
    $.ajax({
        url: './php/getData.php',
        method: "POST",
        data: {},
        dataType: "json", 
        success: function(response){
            $('#student_data tbody').empty();
            $.each(response, function(key,value){
                addNewRecordHTML(value.student_id, value.student_name, value.student_address, value.student_sex);
            });

        }
    });
}

function searchData(){
    var keyword = $('#txtSearch').val();
    $.ajax({
        url: './php/searchData.php',
        method: "GET",
        data: {
            "keyword": keyword
        },
        dataType: "json", 
        success: function(response){
            $('#student_data tbody').empty();
            $.each(response, function(key,value){
                addNewRecordHTML(value.student_id, value.student_name, value.student_address, value.student_sex);
            });

        }
    });

}


$(function(){
    getData();
});