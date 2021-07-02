$(function()
{
	$.ajax(
		{
			type: "GET",
			url: "../php/refreshNewsList.php",
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


	$('body').on("click","#downloadNews",function()
	{
		$.ajax(
			{
				type: "GET",
				url: "../php/downloadNews.php",
				dataType: "json",
				success: function(response)
				{
					alert("Новости загружены");
				},
				error:function(xml){alert("error")}
			});
	});



	$('body').on("click","#refreshNewsList",function()
	{
		$.ajax(
			{
				type: "GET",
				url: "../php/refreshNewsList.php",
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

	$('body').on("click","#deleteNews",function()
	{
		var id=$("#news-list").val();
		var paswordToDelete="";
		var dataToSend={id:id,pasword:paswordToDelete};
		$.ajax(
		{
			type: "POST",
			url: "../php/deleteNews.php",
			dataType: "json",
			data:dataToSend,
			success: function(response)
			{
				$("#news-date").val("");
				$("#text-heading").val("");
				$("#text-news").val("");
				alert("Запись удалена!");
			},
			error:function(response){alert("error")}
		});
	});

	$('body').on("change","#news-list",function()
	{
      var paswordToSave="";
    	var id=$(this).val();

  		var dataToSend={id:id,pasword:paswordToSave};
  		$.ajax(
  		{
  			type: "POST",
  			data:dataToSend,
  			url: "../php/refreshNews.php",
  			dataType: "json",
  			success: function(response)
  			{
  				$("#news-date").val(response.news.date);
  				$("#text-heading").val(response.news.heading);
  				$("#text-news").val(response.news.text);
  			},
  			error:function(response){alert("errorAdd")}
  		});
	});

	$('body').on("click","#choose",function()
	{
		var paswordToSave="";
		var id=$("#news-list").val();

		var dataToSend={id:id,pasword:paswordToSave};
		$.ajax(
		{
			type: "POST",
			data:dataToSend,
			url: "../php/refreshNews.php",
			dataType: "json",
			success: function(response)
			{
				$("#news-date").val(response.news.date);
				$("#text-heading").val(response.news.heading);
				$("#text-news").val(response.news.text);
			},
			error:function(response){alert("errorAdd")}
		});
	});

	$('body').on("click","#saveNewsManually",function()
	{
		var paswordToSave="";

		var id=$("#news-list").val();

		var date = $("#news-date").val();
		var splitDate = date.split("-");

		var day=splitDate[0];
		var month=splitDate[1];
		var year=splitDate[2];

		var heading = $("#text-heading").val();
		var headingWithoutSpaces = heading.replace(/\s/g, '');

		var text = $("#text-news").val();
		var textWithoutSpaces = text.replace(/\s/g, '');

		if (day<1 || day>31)
		{
		  alert("Введите корректное число");
		}
		else
		{
		  if (month<1 || month>12)
		  {
			alert("Введите корректный месяц");
		  }
		  else
		  {
			if (year<1)
			{
			  alert("Введите корректный год");
			}
			else
			{
			  if (headingWithoutSpaces.length<1)
			  {
				alert("Введите заголовок");
			  }
			  else
			  {
				if (textWithoutSpaces<1)
				{
				  alert("Введите текст новости");
				}
				else
				{
				  var dataToSend={id:id,date:date,heading:heading,text:text,pasword:paswordToSave};
				  $.ajax(
				  {
					type: "POST",
					data:dataToSend,
					url: "../php/saveNews.php",
					dataType: "json",
					success: function(response)
					{
					  alert("Запись сохранена");
					},
					error:function(response){alert("errorAdd")}
				  });
				}
			  }
			}
		  }
		}
	});

	$('body').on("click","#addNewsManually",function()
	{
		var passwordToSave="";

		var id=$("#news-list").val();

		var date = $("#news-date").val();
		var splitDate = date.split("-");

		var day=splitDate[0];
		var month=splitDate[1];
		var year=splitDate[2];

		var heading = $("#text-heading").val();
		var headingWithoutSpaces = heading.replace(/\s/g, '');

		var text = $("#text-news").val();
		console.log(text);
		var textWithoutSpaces = text.replace(/\s/g, '');

		if (day<1 || day>31)
		{
		  alert("Введите корректное число");
		}
		else
		{
		  if (month<1 || month>12)
		  {
			alert("Введите корректный месяц");
		  }
		  else
		  {
			if (year<1)
			{
			  alert("Введите корректный год");
			}
			else
			{
			  if (headingWithoutSpaces.length<1)
			  {
				alert("Введите заголовок");
			  }
			  else
			  {
				if (textWithoutSpaces.length<1)
				{
				  alert("Введите текст новости");
				}
				else
				{
				  var dataToSend={date:date,heading:heading,text:text,password:passwordToSave};
				  $.ajax(
				  {
					type: "POST",
					data:dataToSend,
					url: "../php/createNewsManually.php",
					dataType: "json",
					success: function(response)
					{
					  alert("Запись сохранена");
					},
					error:function(response){alert("errorAdd")}
				  });
				}
			  }
			}
		  }
		}
	});
})
