/**
 * Created by Mohiuddin on 7/28/2017.
 */
function switchManagerUserProfile(value) {
    if(value=='user'){
        $.ajax({
            method: "POST",
            url: "../bdiary/managerStatusManagement.php",
            data:{'statusValue': value}
        }).done(function (data) {
           window.location.replace('userHome.php');
        });

    }
    else if (value=='manager'){
        $.ajax({
            method: "POST",
            url: "../bdiary/managerStatusManagement.php",
            data:{'statusValue': value}
        }).done(function (data) {
            window.location.replace('managerHome.php');
        });
    }

}