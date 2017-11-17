$(document).ready(function(){
   $(".btn-delete-item").click(function(event) {
        var result = confirm('Are you sure to want to delete?');
        if (result) {
            $('button').attr('type', 'submit')
        } else {
            
        }
   })
})