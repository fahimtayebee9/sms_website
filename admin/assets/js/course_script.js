var count_session = 1;
$(function () {
    
    $("#addnewSession").click(function () {
        if(count_session > 5 ){
            return false;
        }
        else{

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
            
            document.getElementById('field_area').appendChild(col_6);
            document.getElementById('field_area').appendChild(col_4);
            document.getElementById('field_area').appendChild(col_2);

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
                var text = document.createTextNode('Curriculam Description');
                var lbl = document.createElement('label');
                lbl.setAttribute('class','font-weight-bold');
                lbl.appendChild(text);
                div_form_3.appendChild(lbl);
                div_form_3.appendChild(cur_desc);
                col_12.appendChild(div_form_3);
                document.getElementById('text_area').appendChild(col_12);
            }

        }
        
        count_session++;
    });

});

// $("#btn_remove").click(function (){
//     document.getElementById('field_area').removeChild(document.getElementById('left_node'));
//     document.getElementById('field_area').removeChild(document.getElementById('right_node'));
//     document.getElementById('field_area').removeChild(document.getElementById('btn_node'));
//     document.getElementById('field_area').removeChild(document.getElementById('text_node'));
//     alert("success");
// });

