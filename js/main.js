$(document).ready(function() {
  $(".button-collapse").sideNav();
  $('select').material_select();
  $('.slider').slider();
  $('.materialboxed').materialbox();
});

function register(update) {
  $.get("php/register.php", {
      name: $('#full_name').val(),
      email: $('#email').val(),
      student_id: $('#student_id').val(),
      domain: $('#domain').val(),
      semester: $('#semester').val(),
      year: $('#graduation').val(),
      update: update
    })
    .done(function(data) {
      if(data == 'Thank you for registering!') {
        $('#register_form').html(
          '<a class="flow-text" href="register.php" style="text-decoration: none; color: black">'+
          data+
          '</a>');
      }
      $('#result').html(data);
    });
}