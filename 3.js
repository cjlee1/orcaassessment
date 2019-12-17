
function a (divId){  
    originalDiv= document.getElementById(divId)
    originalDiv.style.display="none";
    var rdiv = document.createElement("div");
    content= document.createTextNode(originalDiv.id);
    rdiv.appendChild(content)
    rdiv.className=originalDiv.className;
    rdiv.style = originalDiv.style
    rdiv.style.display="block";
    rdiv.id="rdiv";
  

    originalDiv.parentNode.insertBefore(rdiv, originalDiv.nextSibling);
   

};
$(document).ready(function() {
    $('#rdiv').click(function(){
        var $originalDiv = $('#rdiv')[0].innerHTML
        $(originalDiv).show();
        $('#rdiv').remove();

    });
});