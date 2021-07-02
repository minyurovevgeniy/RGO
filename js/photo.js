$(function()
{
	$.ajax(
  		{
  			type: "GET",
  			url: "../php/refreshPhotos.php",
  			dataType: "json",
  			success: function(response)
  			{
  				console.log(response);
  				if (response.photos)
  				{
  					var row="";
  					var photos=response.photos;
  					var length = photos.length;
  					for (var i=0;i<length;i++)
  					{
  						row+=
  						'<div class="row" data-id="'+photos[i].id+'">'+
              '<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 id">'+photos[i].id+'</div>'+
              '<div class="col-sm-4 col-md-4 col-sm-4 col-xs-4 date"><img src="'+photos[i].src+'"></div>'+
              '<div class="col-sm-3 col-md-3 col-sm-3 col-xs-3 comment"><textarea class="desc" data-id="'+photos[i].id+'" >'+photos[i].description+'</textarea></div>'+
              '<div class="col-sm-3 col-md-3 col-sm-3 col-xs-3 actions">'+
  							  '<input class="save" type="button" data-id="'+photos[i].id+'" value="Сохранить">'+
  							  '<input class="delete" type="button" data-id="'+photos[i].id+'" value="Удалить">'+
  							'</div>'+
  						'</div>';
  					}
  						$("#photos-list").html(row);
  				}
  			},
  			error:function(xml){alert("error")}
  		});

	$('body').on("click","#refreshPhotos",function()
    {
			$.ajax(
  		{
  			type: "GET",
  			url: "../php/refreshPhotos.php",
  			dataType: "json",
  			success: function(response)
  			{
  				console.log(response);
  				if (response.photos)
  				{
  					var row="";
  					var photos=response.photos;
  					var length = photos.length;
  					for (var i=0;i<length;i++)
  					{
  						row+=
  						'<div class="row" data-id="'+photos[i].id+'">'+
              '<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 id">'+photos[i].id+'</div>'+
              '<div class="col-sm-4 col-md-4 col-sm-4 col-xs-4 date"><img src="'+photos[i].src+'"></div>'+
              '<div class="col-sm-3 col-md-3 col-sm-3 col-xs-3 comment"><textarea class="desc">'+photos[i].description+'</textarea></div>'+
              '<div class="col-sm-3 col-md-3 col-sm-3 col-xs-3 actions">'+
  							  '<input class="save" type="button" data-id="'+photos[i].id+'" value="Сохранить">'+
  							  '<input class="delete" type="button" data-id="'+photos[i].id+'" value="Удалить">'+
  							'</div>'+
  						'</div>';
  					}
  						$("#photos-list").html(row);
  				}
  			},
  			error:function(xml){alert("error")}
  		});
	});

	$('body').on("click",".save",function()
	{
		var id=$(this).attr("data-id");
		var text = $(".desc[data-id="+id+"]").val();
		console.log(text);
		var passwordToSave=$("#save_password").val();
		var dataToSend={id:id,text:text,password:passwordToSave};
		$.ajax
		({
			type: "POST",
			url: "../php/savePhotoComment.php",
			dataType: "json",
			data:dataToSend,
			success: function(response)
			{
				alert("Запись изменена");
			},
			error:function(response){alert("error")}
		});
	});

  $('body').on("click",".delete",function()
	{
		var id=$(this).attr("data-id");
		var passwordToDelete=$("#delete_password").val();
		var dataToSend={id:id,password:passwordToDelete};
		$.ajax(
		{
			type: "POST",
			url: "../php/deletePhoto.php",
			dataType: "json",
			data:dataToSend,
			success: function(response)
			{
				$(".row[data-id="+id+"]").remove();
				alert("OK!");
			},
			error:function(response){alert("error")}
		});
	});

})
