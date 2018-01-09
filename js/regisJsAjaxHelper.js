function submitFunction() {
            $.ajax({
                type:'POST',
                url:'insertSignUp.php',
                data:$('#signUpForm').serialize(),
                // cache:false,
                success:function(response){
                    $('#signUpForm').find('.show_result').html(response);
                }
            });




}