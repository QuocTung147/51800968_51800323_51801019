function dynamicdropdown(listindex) {
    switch (listindex) {
        case "laptrinh":
            document.getElementById("kindApp").options[0] = new Option("Chọn thể loại", "");
            document.getElementById("kindApp").options[1] = new Option("Java", "Java");
            document.getElementById("kindApp").options[2] = new Option("C#", "C#");
            document.getElementById("kindApp").options[3] = new Option("C/C++", "C/C++");
            document.getElementById("kindApp").options[4] = new Option("Python", "Python");
            document.getElementById("kindApp").options[5] = new Option("HTML+JavaScript", "HTML+Javascript");
            break;
        case "tienganh":
            document.getElementById("kindApp").options[0] = new Option("Chọn thể loại", "");
            document.getElementById("kindApp").options[1] = new Option("Toeic", "Toeic");
            document.getElementById("kindApp").options[2] = new Option("Ielts", "Ielts");
            document.getElementById("kindApp").options[3] = new Option("Giao tiếp", "Giao tiếp");
            document.getElementById("kindApp").options[4] = new Option("Toeft", "Toeft");
            document.getElementById("kindApp").options[5] = new Option("Sách", "Sách");
            break;
    }
    return true;
}

function formatNumber(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
    var input_val = input.val();
    if (input_val === "") {
        return;
    }
    var original_len = input_val.length;
    var caret_pos = input.prop("selectionStart");

    if (input_val.indexOf(".") >= 0) {

        var left_side = input_val.substring(0, decimal_pos);
        left_side = formatNumber(left_side);
        right_side = formatNumber(right_side);
        if (blur === "blur") {
            right_side += "00";
        }
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = "$" + left_side + "." + right_side;

    } else {
        input_val = formatNumber(input_val);
    }
    input.val(input_val);
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

$(document).ready(function(){ 
	$('#commentForm').on('submit', function(event){
		event.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			url: "detail_app.php",
			method: "POST",
			data: formData,
			dataType: "JSON",
			success:function(response) {
				if(!response.error) {
					$('#commentForm')[0].reset();
					$('#commentId').val('0');
					$('#message').html(response.message);
					showComments();
				} else if(response.error){
					$('#message').html(response.message);
				}
			}
		})
	});	
});


$(function () {
    $("#closemodal").click(function () {
        $("#confirm").modal("hide");
    });
});

$("#detail a").click(function () {
    $("#detail").collapse("hide");
});

