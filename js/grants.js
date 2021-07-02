$(function()
{

	$.ajax(
		{
			type: "GET",
			url: "../php/refreshGrantsStatusesList.php",
			dataType: "json",
			success: function(response)
			{
				console.log(response);
				var row="";
				if (response.statuses)
				{

					var statuses=response.statuses;
					var length = statuses.length;
					for (var i=0;i<length;i++)
					{
						row+='<option value="'+statuses[i].id+'">'+statuses[i].status+'</option>';
					}

				}
				$("#status").html(row);
			},
			error:function(xml){alert("error")}
		});


	$.ajax(
		{
			type: "GET",
			url: "../php/refreshGrantsList.php",
			dataType: "json",
			success: function(response)
			{
				console.log(response);
				var row="";
				if (response.grants)
				{

					var grants=response.grants;
					var length = grants.length;
					for (var i=0;i<length;i++)
					{
						row+=
						'<option value="'+grants[i].id+'">'+grants[i].annotation+'</option>';
					}

				}
				$("#grants-list").html(row);
			},
			error:function(xml){alert("error")}
		});


	$('body').on("click","#refreshGrantsList",function()
	{
		$.ajax(
			{
				type: "GET",
				url: "../php/refreshGrantsList.php",
				dataType: "json",
				success: function(response)
				{
					console.log(response);
					var row="";
					if (response.grants)
					{

						var grants=response.grants;
						var length = grants.length;
						for (var i=0;i<length;i++)
						{
							row+='<option value="'+grants[i].id+'">'+grants[i].annotation+'</option>';
						}

					}
					$("#grants-list").html(row);
				},
				error:function(xml){alert("error")}
			});
	});

	$('body').on("click","#delete",function()
	{
		var id=$("#grants-list").val();
		var passwordToDelete="";
		var dataToSend={id:id,password:passwordToDelete};
		$.ajax(
		{
			type: "POST",
			url: "../php/deleteGrant.php",
			dataType: "json",
			data:dataToSend,
			success: function(response)
			{
				$("#title").val("");
				$("#supervisor").val("");
				$("#deadline").val("");
				$("#annotation").val("");
				$("#cost").val("");
				$("#status").val(1);
				alert("Запись удалена!");
			},
			error:function(response){alert("error")}
		});
	});

	$('body').on("change","#grants-list",function()
	{
		var passwordToSave="";
		var id=$(this).val();

		var dataToSend={id:id,password:passwordToSave};
		$.ajax(
		{
			type: "POST",
			data:dataToSend,
			url: "../php/refreshGrant.php",
			dataType: "json",
			success: function(response)
			{
				$("#title").val(response.grant.title);
				$("#supervisor").val(response.grant.supervisor);
				$("#deadline").val(response.grant.deadline);
				$("#annotation").val(response.grant.annotation);
				$("#cost").val(response.grant.cost);
				$("#status").val(response.grant.status);
			},
			error:function(response){alert("errorAdd")}
		});
	});

	$('body').on("click","#choose",function()
	{
		var passwordToSave="";
		var id=$("#grants-list").val();

		var dataToSend={id:id,password:passwordToSave};
		$.ajax(
		{
			type: "POST",
			data:dataToSend,
			url: "../php/refreshGrant.php",
			dataType: "json",
			success: function(response)
			{
				$("#title").val(response.grant.title);
				$("#supervisor").val(response.grant.supervisor);
				$("#deadline").val(response.grant.deadline);
				$("#annotation").val(response.grant.annotation);
				$("#cost").val(response.grant.cost);
				$("#status").val(response.grant.status);
			},
			error:function(response){alert("errorAdd")}
		});
	});


	$('body').on("click","#saveGrantManually",function()
	{
		var passwordToSave="";

		var id=$("#grants-list").val();

		var title = $("#title").val();
		var titleWithoutSpaces = title.replace(/\s/g, '');

		var supervisor = $("#supervisor").val();
		var supervisorWithoutSpaces = supervisor.replace(/\s/g, '');

		var deadline = $("#deadline").val();
		var deadlineWithoutSpaces = deadline.replace(/\s/g, '');

		var annotation = $("#annotation").val();
		var annotationWithoutSpaces = annotation.replace(/\s/g, '');

		var cost = $("#cost").val();
		var costWithoutSpaces = cost.replace(/\s/g, '');

		var status = $("#status").val();

		if (titleWithoutSpaces.length<1)
		{
			alert("Введите наименование");
		}
		else
		{
			if (supervisorWithoutSpaces.length<1)
			{
				alert("Введите руководителя");
			}
			else
			{
				if (deadlineWithoutSpaces.length<1)
				{
					alert("Введите сроки реализации");
				}
				else
				{
					if (annotationWithoutSpaces.length<1)
					{
						alert("Введите аннотацию");
					}
					else
					{
						if (costWithoutSpaces.length<1)
						{
							alert("Введите стоимость");
						}
						else
						{
							var dataToSend={id:id,title:title,supervisor:supervisor,deadline:deadline,annotation:annotation,status:status,cost:cost,password:passwordToSave};
							$.ajax(
							{
								type: "POST",
								data:dataToSend,
								url: "../php/saveGrant.php",
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

	$('body').on("click","#addGrantManually",function()
	{
		var passwordToSave="";

		var title = $("#title").val();
		var titleWithoutSpaces = title.replace(/\s/g, '');

		var supervisor = $("#supervisor").val();
		var supervisorWithoutSpaces = supervisor.replace(/\s/g, '');

		var deadline = $("#deadline").val();
		var deadlineWithoutSpaces = deadline.replace(/\s/g, '');

		var annotation = $("#annotation").val();
		var annotationWithoutSpaces = annotation.replace(/\s/g, '');

		var cost = $("#cost").val();
		var costWithoutSpaces = cost.replace(/\s/g, '');

		var status = $("#status").val();

		if (titleWithoutSpaces.length<1)
		{
			alert("Введите наименование");
		}
		else
		{
			if (supervisorWithoutSpaces.length<1)
			{
				alert("Введите руководителя");
			}
			else
			{
				if (deadlineWithoutSpaces.length<1)
				{
					alert("Введите сроки реализации");
				}
				else
				{
					if (annotationWithoutSpaces.length<1)
					{
						alert("Введите аннотацию");
					}
					else
					{
						if (costWithoutSpaces.length<1)
						{
							alert("Введите стоимость");
						}
						else
						{
							var dataToSend={title:title,supervisor:supervisor,deadline:deadline,annotation:annotation,status:status,cost:cost,password:passwordToSave};
							$.ajax(
							{
								type: "POST",
								data:dataToSend,
								url: "../php/createGrantManually.php",
								dataType: "json",
								success: function(response)
								{
									alert("Запись добавлена");
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
