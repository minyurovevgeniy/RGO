$(function()
{
	$.ajax(
		{
			type: "GET",
			url: "../php/refreshGeneral.php",
			dataType: "json",
			success: function(response)
			{
				console.log(response);
				if (response.general)
				{
					var checkedAttr="";
					var row="";
					var general=response.general;
					var length = general.length;
					for (var i=0;i<length;i++)
					{
						checkedAttr="";
						if (general[i].cancel>0)
						{
							checkedAttr="checked";
						}
						row+=
						'<div class="row" data-id="'+general[i].id+'">'+
							'<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 id">'+general[i].id+'</div>'+
							'<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 date"><input type="text" data-id="'+general[i].id+'" value="'+general[i].date+'" class="date"></div>'+
							'<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 time"><input type="text" data-id="'+general[i].id+'" value="'+general[i].start_time+'" class="time"></div>'+
							'<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 end_time"><input type="text" data-id="'+general[i].id+'" value="'+general[i].end_time+'" class="end_time"></div>'+
							'<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 description"><textarea cols="18" class="descr" data-id="'+general[i].id+'">'+general[i].description+'</textarea></div>'+
							'<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 cancel"><input class="cancel" data-id="'+general[i].id+'" type="checkbox" '+checkedAttr+'></div>'+
							'<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 place"><input type="text" data-id="'+general[i].id+'" value="'+general[i].place+'" class="place"></div>'+
							'<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 actions">'+
							  '<input class="save" type="button" data-id="'+general[i].id+'" value="Сохранить">'+
							  '<input class="delete" type="button" data-id="'+general[i].id+'" value="Удалить">'+
							'</div>'+
						'</div>';
					}
						$("#general-list").html(row);
				}
			},
			error:function(xml){alert("error")}
		});
	
	$('body').on("click","#refreshGeneral",function()
	{	
		$.ajax(
		{
			type: "GET",
			url: "../php/refreshGeneral.php",
			dataType: "json",
			success: function(response)
			{
				console.log(response);
				if (response.general)
				{
					var row="";
					var checkedAttr="";
					var general=response.general;
					var length = general.length;
					for (var i=0;i<length;i++)
					{
						checkedAttr="";
						if (general[i].cancel>0)
						{
							checkedAttr="checked";
						}
						row+=
						'<div class="row" data-id="'+general[i].id+'">'+
							'<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 id">'+general[i].id+'</div>'+
							'<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 date"><input type="text" data-id="'+general[i].id+'" value="'+general[i].date+'" class="date"></div>'+
							'<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 time"><input type="text" data-id="'+general[i].id+'" value="'+general[i].start_time+'" class="time"></div>'+
							'<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 end_time"><input type="text" data-id="'+general[i].id+'" value="'+general[i].end_time+'" class="end_time"></div>'+
							'<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 description"><textarea cols="18" class="descr" data-id="'+general[i].id+'">'+general[i].description+'</textarea></div>'+
							'<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 cancel"><input class="cancel" data-id="'+general[i].id+'" type="checkbox" '+checkedAttr+'></div>'+
							'<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 place"><input type="text" data-id="'+general[i].id+'" value="'+general[i].place+'" class="place"></div>'+
							'<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 actions">'+
							  '<input class="save" type="button" data-id="'+general[i].id+'" value="Сохранить">'+
							  '<input class="delete" type="button" data-id="'+general[i].id+'" value="Удалить">'+
							'</div>'+
						'</div>';
					}
						$("#general-list").html(row);
				}
			},
			error:function(xml){alert("error")}
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
			url: "../php/deleteGeneral.php",
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
	
	$('body').on("click","#newGeneral",function()
	{
		var date=$("#newDate").val();
		var dateDetailed=date.split("-");
		var year,month,day;

		
		var description=$("#newDescription").val();
		var descriptionToTest=description.replace(/\s{1,}/ig,'');
		
		var time=$("#newTime").val();
		var start_time=time;
		var startTimeDetailed=time.split(":");
		var start_hour,start_minutes,start_seconds;
		var startTimestamp=0;

		var end_time=$("#newEndTime").val();
		var endTimeDetailed=end_time.split(":");
		var end_hour,end_minutes,end_seconds;
		var endTimestamp=0;
		
		var place=$("#newPlace").val();
		

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
														end_seconds=parseInt(endTimeDetailed[2]);
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
															console.log("Начало :"+startTimestamp.getTime());

															endTimestamp=new Date();
															endTimestamp.setFullYear(year);
															endTimestamp.setMonth(month);
															endTimestamp.setDate(day);
															endTimestamp.setHours(end_hour);
															endTimestamp.setMinutes(end_minutes);
															endTimestamp.setSeconds(end_seconds);
															console.log("Конец  :"+endTimestamp.getTime());

															if (startTimestamp.getTime()<=endTimestamp.getTime())
															{
																var dataToSend={date:date,place:place,time:time,end_time:end_time,description:description,password:passwordToSave};
																$.ajax(
																{
																	type: "POST",
																	data:dataToSend,
																	url: "../php/createGeneralManually.php",
																	dataType: "json",
																	success: function(response)
																	{
																		alert("Событие добавлено");
																	},
																	error:function(response){alert("error")}
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
			alert("Введите описание!");
		}
	});
	
	
	$('body').on("click",".save",function()
	{
		var id=$(this).attr("data-id");

		var date=$(".date[data-id="+id+"]").val();
		var dateDetailed=date.split("-");
		var year,month,day;

		var time=$(".time[data-id="+id+"]").val();
		var start_time=time;
		var startTimeDetailed=time.split(":");
		var start_hour,start_minutes,start_seconds;
		var startTimestamp=0;

		var end_time=$(".end_time[data-id="+id+"]").val();
		var endTimeDetailed=end_time.split(":");
		var end_hour,end_minutes,end_seconds;
		var endTimestamp=0;
		
		var place=$(".place[data-id="+id+"]").val();
		
		var description=$(".descr[data-id="+id+"]").val();
		var descriptionToTest=description.replace(/\s{1,}/ig,'');

		var is_cancelled= ($(".is_cancelled_value[data-id="+id+"]").prop("checked"))? 1 : 0 ;
		console.log("Cancelled: "+is_cancelled);

		var passwordToSave=$("#save_password").val();

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
													end_seconds=parseInt(endTimeDetailed[2]);
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
														console.log("Начало :"+startTimestamp.getTime());

														endTimestamp=new Date();
														endTimestamp.setFullYear(year);
														endTimestamp.setMonth(month);
														endTimestamp.setDate(day);
														endTimestamp.setHours(end_hour);
														endTimestamp.setMinutes(end_minutes);
														endTimestamp.setSeconds(end_seconds);
														console.log("Конец  :"+endTimestamp.getTime());

														if (startTimestamp.getTime()<=endTimestamp.getTime())
														{
															var dataToSend={id:id,date:date,place:place,time:time,end_time:end_time,description:description,password:passwordToSave};
															$.ajax(
															{
																type: "POST",
																data:dataToSend,
																url: "../php/saveGeneral.php",
																dataType: "json",
																success: function(response)
																{
																	alert("Запись изменена");
																},
																error:function(response){alert("error")}
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
	});
	
	$('body').on("click",".cancel",function()
	{
		var id=$(this).attr("data-id");
		var state= ($(this).prop("checked"))? 1 : 0 ;
		var dataToSend={id:id,state:state/*,password:passwordToSave*/};
		$.ajax(
		{
			type: "POST",
			data:dataToSend,
			url: "../php/saveCancelGeneral.php",
			dataType: "json",
			success: function(response)
			{
				alert("Запись изменена");
			},
			error:function(response){alert("error")}
		});
	});
})