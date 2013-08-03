var info_pay = {};

info_pay.search = function() {
  // search form
  $('#search_user_form').on('submit', function(e) {
    e.preventDefault();
    
    $('.total_rows').text('Search Results');
    $('#search_results').html('<li>Loading...</li>');
    
    var params = $(this).serialize();
    
    $.getJSON('proxy.php', params, function(response) {
      if (response.total_rows > 0) {
        var users = '';
      
        $.each(response.users, function() {
          users += '<li><a href="#" data-firstname="'+this.firstname+'" data-lastname="'+this.lastname+'">'+this.firstname+' '+this.lastname+' ('+this.address+', '+this.city+' '+this.state+')</a></li>';
        });
      
        $('#search_results').empty().html(users);
      } else {
        $('#search_results').empty();
      }
      
      $('.total_rows').text(response.total_rows + ' Search Results');
      
      // handle server errors
      if (response.errors !== undefined) {
        $('#server_error').html('<button type="button" class="close" data-dismiss="alert">&times;</button> Oops, something bad happened on the server: ' + response.errors).fadeIn('fast');
      }
    });
  });
  
  // user list
  $('#search_results').on('click', 'a', function(e) {
    e.preventDefault();
    
    // There should be an ajax request here based on some unique identifier for the user to get the details. The response would then be used to populate the modal window.
    
    $('#user_details_modal h4.modal-title').text('User details for ' + $(e.target).data('firstname') + ' ' + $(e.target).data('lastname'));
    
    $('#user_details_modal').modal('show');
  });
}

$(function() {
  info_pay.search();
});