$(function()
{
	$.ajax(
		{
			type: "GET",
			url: "../php/refreshExpeditionsList.php",
			dataType: "json",
			success: function(response)
			{
				console.log(response);
				if (response.expeditions)
				{
					var checkedAttr="";
					var row="";
					var expeditions=response.expeditions;
					var length = expeditions.length;
					for (var i=0;i<length;i++)
					{
						row+='<option value="'+expeditions[i].id+'">'+expeditions[i].date+' '+expeditions[i].description+'</option>';
					}
					$("#expeditions-list").html(row);
				}
			},
			error:function(xml){alert("error")}
		});

	$('body').on("click","#refreshExpeditionsList",function()
	{
		$.ajax(
			{
				type: "GET",
				url: "../php/refreshExpeditionsList.php",
				dataType: "json",
				success: function(response)
				{
					console.log(response);
					if (response.expeditions)
					{
						var checkedAttr="";
						var row="";
						var expeditions=response.expeditions;
						var length = expeditions.length;
						for (var i=0;i<length;i++)
						{
							row+='<option value="'+expeditions[i].id+'">'+expeditions[i].date+' '+expeditions[i].description+'</option>';
						}
						$("#expeditions-list").html(row);
					}
				},
				error:function(xml){alert("error")}
			});
	});

	$('body').on("change","#expeditions-list",function()
	{
		var paswordToSave="";
		var id=$(this).val();

		var dataToSend={id:id,pasword:paswordToSave};
		$.ajax(
		{
			type: "POST",
			data:dataToSend,
			url: "../php/refreshExpedition.php",
			dataType: "json",
			success: function(response)
			{
				$("#expeditions-date").val(response.expedition.date);
				$("#expeditions-time").val(response.expedition.time);
				$("#end-time").val(response.expedition.end_time);
				$("#place").val(response.expedition.place);
				$("#responsible").val(response.expedition.responsible);
				$("#description").val(response.expedition.description);
				$("#announcement").val(response.expedition.announcement);
			},
			error:function(response){alert("errorAdd")}
		});
	});

	$('body').on("click","#deleteExpedition",function()
	{
		var id=$("#expeditions-list").val();
		var passwordToDelete=$("#delete_password").val();
		var dataToSend={id:id,password:passwordToDelete};
		$.ajax(
		{
			type: "POST",
			url: "../php/deleteExpedition.php",
			dataType: "json",
			data:dataToSend,
			success: function(response)
			{
				$("#expeditions-date").val("");
				$("#expeditions-time").val("");
				$("#end-time").val("");
				$("#place").val("");
				$("#responsible").val("");
				$("#description").val("");
				$("#announcement").val("");
			},
			error:function(response){alert("error")}
		});
	});

	$('body').on("click","#addExpeditionManually",function()
	{
		var date=$("#expeditions-date").val();
		var dateDetailed=date.split("-");
		var year,month,day;

		var description=$("#description").val();
		var descriptionToTest=description.replace(/\s{1,}/ig,'');

		var announcement=$("#announcement").val();

		var responsible=$("#responsible").val();
		var responsibleToTest=responsible.replace(/\s{1,}/ig,'');

		var time=$("#expeditions-time").val();
		var start_time=time;
		var startTimeDetailed=time.split(":");
		var start_hour,start_minutes,start_seconds;
		var startTimestamp=0;

		var end_time=$("#end-time").val();
		var endTimeDetailed=end_time.split(":");
		var end_hour,end_minutes,end_seconds;
		var endTimestamp=0;

		var place=$("#place").val();

		var passwordToSave=$("#save_password").val();

	if (descriptionToTest.length>0)
		{
			if ((/^\d\d-\d\d-\d\d\d\d$/gi).test(date))// parse date
			{
				//alert("В дате есть что-то кроме чисел");
				year=parseInt(dateDetailed[2]);
				if(year>0 && Math.floor(year)==year)
				{
					month=parseInt(dateDetailed[1]);
					if (month>=1 && month<=12)
					{
						day=parseInt(dateDetailed[0]);
						days=[31,28,31,30,31,30,31,31,30,31,30,31];
						if (((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0))
						{
							days[1]=29;
						}

						if ((day>=1) && (day<=days[month-1]))
						{
							if ((/^\d\d:\d\d:\d\d$/gi).test(start_time)) // parse start time
							{
								start_hour=parseInt(startTimeDetailed[0]);

								if (start_hour>=0 && start_hour<=23)
								{
									start_minutes=parseInt(startTimeDetailed[1]);
									if (start_minutes>=0 && start_minutes<=59)
									{
										start_seconds=parseInt(startTimeDetailed[2]);
										if (start_seconds>=0 && start_seconds<=59)
										{
											if ((/^\d\d:\d\d:\d\d$/gi).test(end_time))  // parse end time
											{
												end_hour=parseInt(endTimeDetailed[0]);
												if (end_hour>=0 && end_hour<=23)
												{
													end_minutes=parseInt(endTimeDetailed[1]);
													if (end_minutes>=0 && end_minutes<=59)
													{
														end_seconds=parseInt(endTimeDetailed[2])
														if (end_seconds>=0 && end_seconds<=59)
														{
															month--;
															startTimestamp=new Date();
															startTimestamp.setFullYear(year);
															startTimestamp.setMonth(month);
															startTimestamp.setDate(day);
															startTimestamp.setHours(start_hour);
															startTimestamp.setMinutes(start_minutes);
															startTimestamp.setSeconds(start_seconds);

															endTimestamp=new Date();
															endTimestamp.setFullYear(year);
															endTimestamp.setMonth(month);
															endTimestamp.setDate(day);
															endTimestamp.setHours(end_hour);
															endTimestamp.setMinutes(end_minutes);
															endTimestamp.setSeconds(end_seconds);
															console.log(startTimestamp.getTime+'_'+endTimestamp.getTime());

															if (startTimestamp.getTime()<=endTimestamp.getTime())
															{
																var dataToSend={date:date,place:place,time:time,end_time:end_time,description:description,responsible:responsible,announcement:announcement,password:passwordToSave};
																$.ajax(
																{
																	type: "POST",
																	data:dataToSend,
																	url: "../php/createExpeditionManually.php",
																	dataType: "json",
																	success: function(response)
																	{
																		alert("Запись добавлена");
																	},
																	error:function(response){alert("errorAdd ")}
																});
															}
															else
															{
																alert("Время начала должно быть меньше времени конца");
															}
														}
														else
														{
															alert("Секунды конца занятия должны быть в диапазоне от 0 до 59 включительно");
														}
														}
														else
														{
															alert("Минуты конца занятия должны быть в диапазоне от 0 до 59 включительно");
														}
													}
												else
												{
													alert("Час конца занятия должен быть в диапазоне от 0 до 23 включительно");
												}
											}
											else
											{
												alert("Время конца занятия должно быть в формате ЧЧ:ММ:СС");
											}
										}
										else
										{
											alert("Секунды начала занятия должны быть в диапазоне от 0 до 59 включительно");
										}
									}
									else
									{
										alert("Минуты начала занятия должны быть в диапазоне от 0 до 59 включительно");
									}
								}
								else
								{
									alert("Час начала занятия должен быть в диапазоне от 0 до 23 включительно");
								}
							}
							else
							{
								alert("Время начала занятия должно быть в формате ЧЧ:ММ:СС");
							}
						}
						else
						{
							alert("День месяца должен быть в диапазоне от 1 до "+days[month-1]+" включительно");
						}
					}
					else
					{
						alert("Месяц должен быть в диапазоне от 1 до 12 включительно");
					}
				}
				else
				{
					alert("Год должен быть записан целым натуральным числом");
				}
			}
			else
			{
				alert("Дата должна быть записана в формате ДД-ММ-ГГГГ");
			}
		}
		else
		{
			alert("Введите описание");
		}
	});

	$('body').on("click","#saveExpeditionManually",function()
	{

		var id = $("#expeditions-list").val();

		var date=$("#expeditions-date").val();
		var dateDetailed=date.split("-");
		var year,month,day;

		var description=$("#description").val();
		var descriptionToTest=description.replace(/\s{1,}/ig,'');

		var responsible=$("#responsible").val();

		var announcement=$("#announcement").val();

		var time=$("#expeditions-time").val();
		var start_time=time;
		var startTimeDetailed=time.split(":");
		var start_hour,start_minutes,start_seconds;
		var startTimestamp=0;

		var end_time=$("#end-time").val();
		var endTimeDetailed=end_time.split(":");
		var end_hour,end_minutes,end_seconds;
		var endTimestamp=0;

		var place=$("#place").val();

		var passwordToSave=$("#save_password").val();
		if (descriptionToTest.length>0)
		{
			if ((/^\d\d-\d\d-\d\d\d\d$/gi).test(date))// parse date
			{
				//alert("В дате есть что-то кроме чисел");
				year=parseInt(dateDetailed[2]);
				if(year>0 && Math.floor(year)==year)
				{
					month=parseInt(dateDetailed[1]);
					if (month>=1 && month<=12)
					{
						day=parseInt(dateDetailed[0]);
						days=[31,28,31,30,31,30,31,31,30,31,30,31];
						if (((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0))
						{
							days[1]=29;
						}

						if ((day>=1) && (day<=days[month-1]))
						{
							if ((/^\d\d:\d\d:\d\d$/gi).test(start_time)) // parse start time
							{
								start_hour=parseInt(startTimeDetailed[0]);

								if (start_hour>=0 && start_hour<=23)
								{
									start_minutes=parseInt(startTimeDetailed[1]);
									if (start_minutes>=0 && start_minutes<=59)
									{
										start_seconds=parseInt(startTimeDetailed[2]);
										if (start_seconds>=0 && start_seconds<=59)
										{
											if ((/^\d\d:\d\d:\d\d$/gi).test(end_time))  // parse end time
											{
												end_hour=parseInt(endTimeDetailed[0]);
												if (end_hour>=0 && end_hour<=23)
												{
													end_minutes=parseInt(endTimeDetailed[1]);
													if (end_minutes>=0 && end_minutes<=59)
													{
														end_seconds=parseInt(endTimeDetailed[2])
														if (end_seconds>=0 && end_seconds<=59)
														{
															month--;
															startTimestamp=new Date();
															startTimestamp.setFullYear(year);
															startTimestamp.setMonth(month);
															startTimestamp.setDate(day);
															startTimestamp.setHours(start_hour);
															startTimestamp.setMinutes(start_minutes);
															startTimestamp.setSeconds(start_seconds);

															endTimestamp=new Date();
															endTimestamp.setFullYear(year);
															endTimestamp.setMonth(month);
															endTimestamp.setDate(day);
															endTimestamp.setHours(end_hour);
															endTimestamp.setMinutes(end_minutes);
															endTimestamp.setSeconds(end_seconds);

															if (startTimestamp.getTime()<=endTimestamp.getTime())
															{
																var dataToSend={id:id,date:date,place:place,time:time,end_time:end_time,description:description,responsible:responsible,announcement:announcement,password:passwordToSave};
																$.ajax(
																{
																	type: "POST",
																	data:dataToSend,
																	url: "../php/saveExpedition.php",
																	dataType: "json",
																	success: function(response)
																	{
																		alert("Запись изменена");
																	},
																	error:function(response){alert("errorSave")}
																});
															}
															else
															{
																alert("Время начала должно быть меньше времени конца");
															}
														}
														else
														{
															alert("Секунды конца занятия должны быть в диапазоне от 0 до 59 включительно");
														}
														}
														else
														{
															alert("Минуты конца занятия должны быть в диапазоне от 0 до 59 включительно");
														}
													}
												else
												{
													alert("Час конца занятия должен быть в диапазоне от 0 до 23 включительно");
												}
											}
											else
											{
												alert("Время конца занятия должно быть в формате ЧЧ:ММ:СС");
											}
										}
										else
										{
											alert("Секунды начала занятия должны быть в диапазоне от 0 до 59 включительно");
										}
									}
									else
									{
										alert("Минуты начала занятия должны быть в диапазоне от 0 до 59 включительно");
									}
								}
								else
								{
									alert("Час начала занятия должен быть в диапазоне от 0 до 23 включительно");
								}
							}
							else
							{
								alert("Время начала занятия должно быть в формате ЧЧ:ММ:СС");
							}
						}
						else
						{
							alert("День месяца должен быть в диапазоне от 1 до "+days[month-1]+" включительно");
						}
					}
					else
					{
						alert("Месяц должен быть в диапазоне от 1 до 12 включительно");
					}
				}
				else
				{
					alert("Год должен быть записан целым натуральным числом");
				}
			}
			else
			{
				alert("Дата должна быть записана в формате ДД-ММ-ГГГГ");
			}
		}
		else
		{
			alert("Введите описание");
		}
	});

	$('body').on("click","#choose",function()
	{
		var paswordToSave="";
		var id=$("#expeditions-list").val();

		var dataToSend={id:id,pasword:paswordToSave};
		$.ajax(
		{
			type: "POST",
			data:dataToSend,
			url: "../php/refreshExpedition.php",
			dataType: "json",
			success: function(response)
			{
				$("#expeditions-date").val(response.expedition.date);
				$("#expeditions-time").val(response.expedition.time);
				$("#end-time").val(response.expedition.end_time);
				$("#place").val(response.expedition.place);
				$("#responsible").val(response.expedition.responsible);
				$("#description").val(response.expedition.description);
				$("#announcement").val(response.expedition.announcement);
			},
			error:function(response){alert("errorAdd")}
		});
	});

})
