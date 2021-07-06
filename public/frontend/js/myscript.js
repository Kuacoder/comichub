var close_modal = document.getElementById('close_modal');
if(close_modal != null){
    let this_modal = document.getElementById('modal');
    close_modal.addEventListener('click',function(){
        this_modal.classList.add('hidden');
    });
}
function checkcoverimg() {
    let this_coverimg = document.getElementById('this_coverimg').value;
    if(this_coverimg == ''){
      document.getElementById("cover_img_err").innerHTML = "Vui lòng chọn 1 ảnh!";
      return false;
    }
}

function checkaddcash() {
  let cash_more = document.getElementById('cash_more').value;
  if(cash_more == ''){
    document.getElementById("cash_more_err").innerHTML = "Vui lòng nhập số lượng nguyệt tinh!";
    return false;
  }
}
$('input[type="file"]').on('change',function(){
  let value = $(this).val();
  $('.label_file_vip').text(value);
});
$('.open_delete_customer').click(function(){
  $('#modal_delete_customer').removeClass('hidden');
});
$('.napthe').click(function(){
  $('#modal--buy').addClass('hidden');
});
$('.nhap_lai').click(function(){
  $('#loaithe').val(0);
  $('#menhgia').val(0);
  $('#serial').val('');
  $('#ma_the').val('');
});
  $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
// var open_delete_customer = document.getElementById('open_delete_customer');
// open_delete_customer.addEventListener('click', function(){
//   let 
// });

function validateForm() {
  var admin_name = document.forms["myForm"]["admin_name"].value;
  var admin_avatar = document.forms["myForm"]["admin_avatar"].value;
  var admin_email = document.forms["myForm"]["admin_email"].value;
  var admin_password = document.forms["myForm"]["admin_password"].value;
  var admin_birthday = document.forms["myForm"]["admin_birthday"].value;
  var admin_phone = document.forms["myForm"]["admin_phone"].value;
  var admin_address = document.forms["myForm"]["admin_address"].value;
  if (admin_name == "") {
    document.getElementById("admin_name_err").innerHTML = "Không được để trống bất kỳ trường nào";
    return false;
  }
  if (admin_avatar == "") {
    document.getElementById("admin_avatar_err").innerHTML = "Không được để trống bất kỳ trường nào";
    return false;
  }
  if (admin_email == "") {
    document.getElementById("admin_email_err").innerHTML = "Không được để trống bất kỳ trường nào";
    return false;
  }
  if (admin_password == "") {
    document.getElementById("admin_password_err").innerHTML = "Không được để trống bất kỳ trường nào";
    return false;
  }
  if (admin_birthday == "") {
    document.getElementById("admin_birthday_err").innerHTML = "Không được để trống bất kỳ trường nào";
    return false;
  }
  if (admin_phone == "") {
    document.getElementById("admin_phone_err").innerHTML = "Không được để trống bất kỳ trường nào";
    return false;
  }
  if (admin_address == "") {
    document.getElementById("admin_address_err").innerHTML = "Không được để trống bất kỳ trường nào";
    return false;
  }

  
}
