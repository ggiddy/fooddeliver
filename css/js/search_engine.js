$(document).ready(function(){
    var id;
$("#search").keyup(function(){
	var searchField = $("#search").val();
	var myExp = new RegExp(searchField, "i");
		$.getJSON('http://localhost/fooddeliver/data.json', function(data){
		var output = '<ul class="nav nav-sidebar">';
		$.each(data, function(key, val){
                     
			if ((val.item_name.search(myExp) !== -1))
			{
                           output += '<div class="well-sm margin_bottom">';
                           output += '<form>';
                           output += '<li>'; 
                           output += val.item_name;
                           output += '</li>';
                           output += '<li>';
                           output += "Ksh."+val.price;
                           id = val.id;
                           output += '</li>';
                           output += '<button id="add" class="btn btn-warning btn-sm" >Add To Chart</button>';
                           output +='</form>';
                           output +='</div>';
			}
		});
                
		output +='</ul>';
                
		$("#resultsDiv").html(output);
                $("#add").click(function(){
                   $.ajax(
                       {
                           url:"http://localhost/fooddeliver/home/add",
                           type: "post",
                           data: {id: id}
                       });
                });
               reld();
	});
    });
});