$(function()
{
	$.ajax(
		{
			type: "GET",
			url: "../php/refreshBooksList.php",
			dataType: "json",
			success: function(response)
			{
				console.log(response);
				if (response.books)
				{
					var row="";
					var books=response.books;
					var length = books.length;
					for (var i=0;i<length;i++)
					{
						row+='<option value="'+books[i].id+'">'+books[i].title+'</option>';
					}
					$("#book-list").html(row);
				}
			},
			error:function(xml){alert("error")}
		});

	$('body').on("click","#refreshBooksList",function()
	{
		$.ajax(
		{
			type: "GET",
			url: "../php/refreshBooksList.php",
			dataType: "json",
			success: function(response)
			{
				console.log(response);
				if (response.books)
				{
					var row="";
					var books=response.books;
					var length = books.length;
					for (var i=0;i<length;i++)
					{
						row+='<option value="'+books[i].id+'">'+books[i].title+'</option>';
					}
					$("#book-list").html(row);
				}
			},
			error:function(xml){alert("error")}
		});
	});

	$('body').on("change","#book-list",function()
	{
		var passwordToSave="";
		var id=$(this).val();

		var dataToSend={id:id,pasword:passwordToSave};
		$.ajax(
		{
			type: "POST",
			data:dataToSend,
			url: "../php/refreshBook.php",
			dataType: "json",
			success: function(response)
			{
				$("#book-title").val(response.book.title);
				$("#book-authors").val(response.book.authors);
				$("#book-coauthors").val(response.book.coauthors);
				$("#book-publisher").val(response.book.publisher);
				$("#book-year").val(response.book.year);
				$("#book-volume").val(response.book.volume);
				$("#book-url").val(response.book.url);
			},
			error:function(response){alert("errorAdd")}
		});
	});

	$('body').on("click","#deleteBook",function()
	{
		var id=$("#book-list").val();
		var passwordToDelete=$("#delete_password").val();
		var dataToSend={id:id,password:passwordToDelete};
		$.ajax(
		{
			type: "POST",
			url: "../php/deleteBook.php",
			dataType: "json",
			data:dataToSend,
			success: function(response)
			{
				$("#book-date").val("");
				$("#book-time").val("");
				$("#end-time").val("");
				$("#place").val("");
				$("#responsible").val("");
				$("#description").val("");
				$("#announcement").val("");
				alert("Запись удалена");
			},
			error:function(response){alert("error")}
		});
	});

	$('body').on("click","#addBookManually",function()
	{
		//Наименование
		var bookTitle=$("#book-title").val();
		var bookTitleToTest=bookTitle.replace(/\s{1,}/ig,'');
		
		//Автор(ы)
		var bookAuthors=$("#book-authors").val();
		var bookAuthorsToTest=bookAuthors.replace(/\s{1,}/ig,'');
		
		//Соавторы
		var bookCoauthors=$("#book-coauthors").val();
		var bookCoauthorsToTest=bookCoauthors.replace(/\s{1,}/ig,'');
		
		//Издательство
		var bookPublisher=$("#book-publisher").val();
		var bookPublisherToTest=bookPublisher.replace(/\s{1,}/ig,'');
		
		//Год издания
		var bookYear=$("#book-year").val();
		var bookYearToTest=bookYear.replace(/\s{1,}/ig,'');
		
		//Объем, страниц
		var bookVolume=$("#book-volume").val();
		var bookVolumeToTest=bookVolume.replace(/\s{1,}/ig,'');

		//Объем, страниц
		var bookUrl=$("#book-url").val();
		var bookUrlToTest=bookUrl.replace(/\s{1,}/ig,'');

		var passwordToSave=$("#save_password").val();

		if (bookTitleToTest.length>0)
		{
			if (bookAuthorsToTest.length>0)
			{
				if (bookCoauthorsToTest.length>0)
				{
					if(bookPublisherToTest.length>0)
					{
						if(!/\D/ig.test(bookYearToTest))
						{
							if (bookUrlToTest.length>0)
							{
								if (bookVolumeToTest.length>0)
								{
									var dataToSend={book_title:bookTitle,book_authors:bookAuthors,book_coauthors:bookCoauthors,book_publisher:bookPublisher,book_year:bookYear,book_volume:bookVolume,book_url:bookUrl};
									$.ajax(
									{
										type: "POST",
										data:dataToSend,
										url: "../php/createBookManually.php",
										dataType: "json",
										success: function(response)
										{
											alert("Запись добавлена");
										},
										error:function(response){alert("errorAdd ")}
									});
								}
								else
								{}
							}
							else
							{
								alert("Введите ссылку на издание");
							}
						}
						else
						{
							alert("Введите год издания");
						}
					}
					else
					{
						alert("Введите издателя");
					}
				}
				else
				{
					alert("Введите соавторов");
				}
			}
			else
			{
				alert("Введите авторов");
			}
		}	
		else
		{
			alert("Введите наименование");
		}
	});

	$('body').on("click","#saveBookManually",function()
	{

		var id=$("#book-list").val();

		//Наименование
		var bookTitle=$("#book-title").val();
		var bookTitleToTest=bookTitle.replace(/\s{1,}/ig,'');
		
		//Автор(ы)
		var bookAuthors=$("#book-authors").val();
		var bookAuthorsToTest=bookAuthors.replace(/\s{1,}/ig,'');
		
		//Соавторы
		var bookCoauthors=$("#book-coauthors").val();
		var bookCoauthorsToTest=bookCoauthors.replace(/\s{1,}/ig,'');
		
		//Издательство
		var bookPublisher=$("#book-publisher").val();
		var bookPublisherToTest=bookPublisher.replace(/\s{1,}/ig,'');
		
		//Год издания
		var bookYear=$("#book-year").val();
		var bookYearToTest=bookYear.replace(/\s{1,}/ig,'');
		
		//Объем, страниц
		var bookVolume=$("#book-volume").val();
		var bookVolumeToTest=bookVolume.replace(/\s{1,}/ig,'');

		//Объем, страниц
		var bookUrl=$("#book-url").val();
		var bookUrlToTest=bookUrl.replace(/\s{1,}/ig,'');

		var passwordToSave=$("#save_password").val();

		if (bookTitleToTest.length>0)
		{
			if (bookAuthorsToTest.length>0)
			{
				if (bookCoauthorsToTest.length>0)
				{
					if(bookPublisherToTest.length>0)
					{
						if(!/\D/ig.test(bookYearToTest))
						{
							if (bookUrlToTest.length>0)
							{
								if (bookVolumeToTest.length>0)
								{
									var dataToSend={id:id,book_title:bookTitle,book_authors:bookAuthors,book_coauthors:bookCoauthors,book_publisher:bookPublisher,book_year:bookYear,book_volume:bookVolume,book_url:bookUrl};
									$.ajax(
									{
										type: "POST",
										data:dataToSend,
										url: "../php/saveBook.php",
										dataType: "json",
										success: function(response)
										{
											alert("Запись изменена");
										},
										error:function(response){alert("errorAdd ")}
									});
								}
								else
								{}
							}
							else
							{
								alert("Введите ссылку на издание");
							}
						}
						else
						{
							alert("Введите год издания");
						}
					}
					else
					{
						alert("Введите издателя");
					}
				}
				else
				{
					alert("Введите соавторов");
				}
			}
			else
			{
				alert("Введите авторов");
			}
		}	
		else
		{
			alert("Введите наименование");
		}
	});

	$('body').on("click","#choose",function()
	{
		var passwordToSave="";
		var id=$("#book-list").val();

		var dataToSend={id:id,password:passwordToSave};
		$.ajax(
		{
			type: "POST",
			data:dataToSend,
			url: "../php/refreshBook.php",
			dataType: "json",
			success: function(response)
			{
				$("#book-title").val(response.book.title);
				$("#book-authors").val(response.book.authors);
				$("#book-coauthors").val(response.book.coauthors);
				$("#book-publisher").val(response.book.publisher);
				$("#book-year").val(response.book.year);
				$("#book-volume").val(response.book.volume);
				$("#book-url").val(response.book.url);
			},
			error:function(response){alert("errorAdd")}
		});
	});
})