<!DOCTYPE html>
<html>
<head>
    <title>Search Page</title>
    <style>

.search-wrapper {
width:465px;
height:45px;
background-color:#f0f0f0;
margin:43px auto 0;
border:1px solid #e9e9e9;
position:relative;
}
.search-box {
width:375px;
height:32px;
background-color:#fff;
margin:5px 7px;
border:1px solid #cfcfcf;
position:relative;
}
.search-box img.search-icon {
margin:8px 0 0 5px;
}
.search-box input {
border:none;
margin:0;
position:absolute;
font-size:16px;
padding-left:5px;
height:30px;
width:332px;
padding-right:5px;
}
input.submit-button {
background:url('Resource/searchIcon.png') no-repeat;
text-indent:-9999px;
border:none;
height:32px;
width:68px;
position:absolute;
top:6px;
left:390px;
cursor:pointer;
    color: black;
}
</style>
    </head>
<body>
<div class="search-wrapper">
    <form action="" method="get" name="search">
        <div class="search-box">
            <img class="search-icon" src="Resource/searchIcon.png" width="21" height="18" alt="search icon" />
            <input name="search" id="searchInput" type="text" placeholder="Search for Users" onkeyup="searchResult(this.value)"/>
            <div id="searchAnswer"></div>
        </div>
        <input class="submit-button" name="Go" type="submit" value="Go"/>
    </form>
</div>

    <script type="text/javascript">
        function searchResult(str) {
            if (str.length==0) {
                document.getElementById("searchAnswer").innerHTML="";
                document.getElementById("searchAnswer").style.border="0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
                var value=document.getElementById("searchInput").value;
            } else {  // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("searchAnswer").innerHTML=this.responseText;
                    document.getElementById("searchAnswer").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET","searchBoxCode.php?q="+value,true);
            xmlhttp.send();
        }
    </script>


</body>
</html>