var modal = document.getElementById('myModal');

var moreThanOneBreakfastButton = document.getElementById("moreThanOneBreakfast");
var moreThanOneLunchButton = document.getElementById("moreThanOneLunch");
var moreThanOneDinnerButton = document.getElementById("moreThanOneDinner");
var cancelButton=document.getElementById('cancelButton');
var closeButton=document.getElementById("closeButton");

// Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal

moreThanOneBreakfastButton.onclick=function(){
    modal.style.display="block";
    document.getElementById('selected_header_time').innerHTML="Breakfast";
};
moreThanOneLunchButton.onclick=function(){
    modal.style.display="block";
    document.getElementById('selected_header_time').innerHTML="Lunch";
};

moreThanOneDinnerButton.onclick=function (){
    modal.style.display="block";
    document.getElementById('selected_header_time').innerHTML="Dinner";
};


// When the user clicks on <span> (x), close the modal
    closeButton.onclick = function() {
        modal.style.display = "none";

    };



// When the user clicks anywhere outside of the modal, close it
    /*window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "block";
        }
    }*/

cancelButton.onclick=function () {
    modal.style.display='none';
};

