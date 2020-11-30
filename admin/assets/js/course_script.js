var count_session = 1;
$(function () {
    
    $("#addnewSession").click(function () {
        if(count_session > 5 ){
            return false;
        }
        else{
            var div_row = null;
            if ($(".field_area").length === 0){
                div_row = document.createElement('div');
                div_row.setAttribute('class','row field_area');
                div_row.setAttribute('id','field_area');
                createDocument(div_row);
            }
            else {
                div_row = document.getElementById('field_area');
                createDocument(div_row);
            }
        }
        count_session++;
    });

});

function createDocument(div_row){
    var col_12 = document.createElement('div');
    col_12.setAttribute('class','col-md-12');
    col_12.setAttribute('id','field_col');

    var div_row_sub = document.createElement('div');
    div_row_sub.setAttribute('class','row field_area_sub');
    div_row_sub.setAttribute('id','field_area_sub');

    var col_6 = document.createElement('div');
    var col_4 = document.createElement('div');
    var col_2 = document.createElement('div');

    col_2.setAttribute('class','col-md-1 m-auto text-center');
    col_2.setAttribute('id','btn_node');
    col_4.setAttribute('class','col-md-5');
    col_4.setAttribute('id','right_node');
    col_6.setAttribute('class','col-md-6');
    col_6.setAttribute('id','left_node');

    var div_form_1 = document.createElement('div');
    div_form_1.setAttribute('class','form-group');

    var div_form_2 = document.createElement('div');
    div_form_2.setAttribute('class','form-group');

    var div_form_4 = document.createElement('div');
    div_form_4.setAttribute('class','form-group align-items-center m-auto');
    

    var label_1 = document.createElement('label');
    var text_node_1 = document.createTextNode('Session Title');
    label_1.appendChild(text_node_1);

    var input_text = document.createElement('input');
    input_text.setAttribute('class','form-control');
    input_text.setAttribute('type','text');
    input_text.setAttribute('name',"cur_session_title[]");

    var label_2 = document.createElement('label');
    var text_node_2 = document.createTextNode('Session Duration');
    label_2.appendChild(text_node_2);

    var select_dur = document.createElement('select');
    select_dur.setAttribute('class','form-control');
    select_dur.setAttribute('type','text');
    select_dur.setAttribute('name',"cur_session_duration[]");
    select_dur.setAttribute('id','select2dur');

    // EMPTY OPTION
    var option_emp = document.createElement('option');
    var emp_text = document.createTextNode("Please Select Duration");
    option_emp.appendChild(emp_text);
    select_dur.appendChild(option_emp);

    var c = 1;
    while(c <= 5){
        var option = document.createElement('option');
        var option_text = document.createTextNode( c + " Month");
        option.setAttribute('value',c);
        option.appendChild(option_text);
        select_dur.appendChild(option);
        c++;
    }

    var btn_new = document.createElement('button');
    btn_new.setAttribute('type','button');
    btn_new.setAttribute('class','btn btn-outline-danger');
    btn_new.setAttribute('id','hideall');
    btn_new.setAttribute('onclick','clickReset()');

    var i_tag = document.createElement('i');
    i_tag.setAttribute('class','fas fa-trash-alt');

    btn_new.appendChild(i_tag);

    div_form_1.appendChild(label_1);
    div_form_1.appendChild(input_text);
    div_form_2.appendChild(label_2);
    div_form_2.appendChild(select_dur);
    div_form_4.appendChild(btn_new);
    
    col_6.appendChild(div_form_1);
    col_4.appendChild(div_form_2);
    col_2.appendChild(div_form_4);

    div_row_sub.appendChild(col_6);
    div_row_sub.appendChild(col_4);
    div_row_sub.appendChild(col_2);

    col_12.append(div_row_sub);

    div_row.appendChild(col_12);

    document.getElementById('curriculum_data').appendChild(div_row);

    if(count_session == 1){
        var cur_desc = document.createElement('textarea');
        cur_desc.setAttribute('style','width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;');
        cur_desc.setAttribute('name','cur_desc');
        cur_desc.setAttribute('class','textarea');
        cur_desc.setAttribute('placeholder','Place some text here');

        var div_form_3 = document.createElement('div');
        div_form_3.setAttribute('class','form-group');

        var col_12 = document.createElement('div');
        col_12.setAttribute('class','col-md-12');
        col_12.setAttribute('id','text_node');

        var div_rowTx = document.createElement('div');
        div_rowTx.setAttribute('class','row text_area');
        div_rowTx.setAttribute('id','text_area');

        var lbl = document.createElement('label');
        lbl.setAttribute('class','d-flex');

        var span_lbl = document.createElement('span');
        var text = document.createTextNode('Curriculam Description');
        span_lbl.setAttribute('class','font-weight-bold');
        
        var btn_rmv = document.createElement('button');
        btn_rmv.setAttribute('class','btn btn-sm btn-outline-danger d-inline ml-3');
        btn_rmv.setAttribute('onclick','removeDesc()');
        btn_rmv.setAttribute('type','button');
        var i_tag2 = document.createElement('i');
        i_tag2.setAttribute('class','fas fa-trash-alt');

        btn_rmv.appendChild(i_tag2);
        span_lbl.appendChild(text);
        lbl.appendChild(span_lbl);
        lbl.appendChild(btn_rmv);

        div_form_3.appendChild(lbl);
        div_form_3.appendChild(cur_desc);
        col_12.appendChild(div_form_3);
        div_rowTx.appendChild(col_12);
        document.getElementById('curriculum_data').appendChild(div_rowTx);
    }
}

function clickReset(){
    document.getElementById('field_area').removeChild(document.getElementById('field_col'));
    count_session -= 1;
}

function removeDesc(){
    document.getElementById('text_area').removeChild(document.getElementById('text_node'));
}