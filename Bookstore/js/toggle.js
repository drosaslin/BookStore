$(document).ready(function(){
    $("#btban").click(function(){
        $("#ban").toggle(500);
		
    });
    $("#btwarning").click(function(){
        $("#warning").toggle(500);
    });
});

function myfunc(switchban){
var className=switchban.getAttribute("class")
if(className=="fa fa-plus fa-3x"){
switchban.className="fa fa-minus fa-3x"
}
else{
switchban.className="fa fa-plus fa-3x"
}
}

function myfunc(switchwarning){
var className=switchwarning.getAttribute("class")
if(className=="fa fa-plus fa-3x"){
switchwarning.className="fa fa-minus fa-3x"
}
else{
switchwarning.className="fa fa-plus fa-3x"
}
}