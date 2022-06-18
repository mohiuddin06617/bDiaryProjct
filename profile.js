$(document).ready(function () {
    var managerGroupAddButton=$("#managerGroupAddButton");
    managerGroupAddButton.on('click',function () {
       var preferredMember=managerGroupAddButton.val();
        managerMemberAdd(preferredMember);
    });
   function managerMemberAdd(id) {
       if(confirm("Are you sure you want to Add Him in this group?")) {
           $.ajax({
               url: "profileEntry.php",
               type: "POST",
               data:'userId='+id,
               success: function(data){
                   managerGroupAddButton.remove();

                   $("#extra").fadeIn("<button class='btn btn-primary disabled' type='button'>Added</button>")
                   $('#addResult').html(data);
               },
               error: function (request, status, error) {
                   alert(request.responseText);
               }
           });
       }

   } 
});