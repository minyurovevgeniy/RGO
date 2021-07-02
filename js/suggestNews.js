$(function()
{
	$.ajax(
		{
			type: "GET",
			url: "../php/refreshSuggestNewsList.php",
			dataType: "json",
			success: function(response)
			{
				console.log(response.news);
				var row="";
				if (response.news)
				{
					var news=response.news;
					var length = news.length;
					for (var i=0;i<length;i++)
					{
						row+='<option value="'+news[i].id+'">'+news[i].date+' '+news[i].heading+'</option>';
					}

				}
				$("#news-list").html(row);
			},
			error:function(xml){alert("error")}
		});


/*
	$('body').on("click","#refreshSuggestNewsList",function()
	{
		$.ajax(
			{
				type: "GET",
				url: "../php/refreshSuggestNewsList.php",
				dataType: "json",
				success: function(response)
				{
					console.log(response);
					var row="";
					if (response.news)
					{

						var news=response.news;
						var length = news.length;
						for (var i=0;i<length;i++)
						{
							row+='<option value="'+news[i].id+'">'+news[i].date+' '+news[i].heading+'</option>';
						}

					}
					$("#news-list").html(row);
				},
				error:function(xml){alert("error")}
			});
	});
*/

	$('body').on("click","#choose",function()
	{
      var passwordToSave="";
    	var id=$("#news-list").val();
  		var dataToSend={id:id,password:passwordToSave};
  		$.ajax(
  		{
  			type: "POST",
  			data:dataToSend,
  			url: "../php/refreshSuggestNews.php",
  			dataType: "json",
  			success: function(response)
  			{
					console.log(response);
  				$("#news-date").val(response.date);
  				$("#text-heading").val(response.heading);
  				$("#text-news").text(response.text);


  			},
  			error:function(response){alert("errorAdd")}
  		});
	});


})
