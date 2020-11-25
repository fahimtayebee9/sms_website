
var div_sec = document.createElement("div");
div_sec.setAttribute('class','main-file-info');

var div_row = document.createElement("div");
div_row.setAttribute('class','row align-items-center mb-3 bg-light bg-custom');


var div_col3 = document.createElement("div");
div_col3.setAttribute('class','col-md-3');

var div_col7 = document.createElement("div");
div_col7.setAttribute('class','col-md-7');

var img_tag = document.createElement("img");
img_tag.setAttribute('id','preview_file');
img_tag.setAttribute('class','w-100');
img_tag.style.width  = '100px';
img_tag.style.height = '120px';
div_col3.appendChild(img_tag);

var table = document.createElement("table");
var tbody = document.createElement("tbody");

var div_col2 = document.createElement("div");
div_col2.setAttribute('class','col-md-2 text-center');

var button = document.createElement("button");
button.setAttribute('type','reset');
button.setAttribute('class','btn btn-outline-danger');
button.setAttribute('onclick','resetPreview()');
button.setAttribute('id','reset_btn');

var i_tag = document.createElement("i");
i_tag.setAttribute('class','fas fa-trash-alt');

var i = 0;
while(i < 3){
    var tr_new = document.createElement("tr");
    var count = 0;
    while(count < 3){
        var td_new = document.createElement("td");
        var span = document.createElement('span');

        // 1st row 
        if(i == 0 && count == 0){
            td_new.setAttribute('width','30%');
            var node = document.createTextNode("File Name");
            span.setAttribute('class','font-weight-bold');
            td_new.appendChild(span);
            span.appendChild(node);
        }
        else if(i == 0 && count == 1){
            var node = document.createTextNode(":");
            span.setAttribute('class','pl-2 pr-2');
            td_new.appendChild(span);
            span.appendChild(node);
        }
        else if(i == 0 && count == 2){
            span.setAttribute('id','file_name');
            td_new.appendChild(span);
        }

        // 2nd row 
        if(i == 1 && count == 0){
            var node = document.createTextNode("Size");
            span.setAttribute('class','font-weight-bold');
            td_new.appendChild(span);
            span.appendChild(node);
        }
        else if(i ==  1 && count == 1){
            var node = document.createTextNode(":");
            span.setAttribute('class','pl-2 pr-2');
            td_new.appendChild(span);
            span.appendChild(node);
        }
        else if(i == 1 && count == 2){
            span.setAttribute('id','file_size');
            td_new.appendChild(span);
        }

        // 3rd row 
        if(i == 2 && count == 0){
            var node = document.createTextNode("Type");
            span.setAttribute('class','font-weight-bold');
            td_new.appendChild(span);
            span.appendChild(node);
        }
        else if(i ==  2 && count == 1){
            var node = document.createTextNode(":");
            span.setAttribute('class','pl-2 pr-2');
            td_new.appendChild(span);
            span.appendChild(node);
        }
        else if(i == 2 && count == 2){
            span.setAttribute('id','file_type');
            var span_2 = document.createElement('span');
            span_2.setAttribute('id','validate');
            span_2.setAttribute('class','text-danger');
            
            td_new.appendChild(span);
            td_new.appendChild(span_2);
        }
        tr_new.appendChild(td_new);
        count++;
    }
    tbody.appendChild(tr_new);
    i++;
}

table.appendChild(tbody);
div_col7.appendChild(table);
div_row.appendChild(div_col3);
div_row.appendChild(div_col7);
button.appendChild(i_tag);
div_col2.appendChild(button);
div_row.appendChild(div_col2);
div_sec.appendChild(div_row);

var element = document.getElementById("preview_block");
element.appendChild(div_sec);

$(function () {
    $("#profile_image").change(function () {
        if (this.files && this.files[0]) {
            document.getElementById('preview_block').style.display = "block";
            var reader = new FileReader();
            reader.onload = function (e) {
                var file_name = document.getElementById('profile_image').files[0].name;
                var sizeMb = document.getElementById('profile_image').files[0].size / (1024 * 1024);
                var file_type = document.getElementById('profile_image').files[0].type;
                
                document.getElementById('preview_block').style.maxHeight = "200px";
                document.getElementById('file_name').innerHTML = file_name;
                document.getElementById('file_size').innerHTML = sizeMb.toFixed(3) + " Mb";
                document.getElementById('choose_file').innerHTML = file_name;
                var valid_types = ["jpg", "jpeg", "png", "gif"];
                var type_check = valid_types.includes(file_type.split('/')[1].toLowerCase());

                if(type_check){
                    // document.getElementById('preview_file').src = window.URL.createObjectURL(document.getElementById('profile_image').files[0]);
                    document.getElementById('file_type').innerHTML = file_type.split('/')[1] + "";
                    document.getElementById('validate').innerHTML  = "";
                    $('#preview_file').attr('src', e.target.result);
                }
                else{
                    $("#preview_file").attr("src", "https://webstockreview.net/images/google-docs-icon-png-3.png");
                    document.getElementById('file_type').innerHTML = file_type.split('/')[1];
                    document.getElementById('validate').innerHTML  = "(not valid file)";
                }
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
});

$("#reset_btn").click(function (){
    document.getElementById('preview_block').style.display = "none";
    document.getElementById('file_name').innerHTML = "File Name : ";
    document.getElementById('file_size').innerHTML = "File Size : ";
    document.getElementById('preview_file').src = "";
    document.getElementById('profile_image').value = null;
    document.getElementById('choose_file').innerHTML = "Choose File";
});