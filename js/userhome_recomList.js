var recomList = new cookieList('recomList');
var items = recomList.items();

items = unique(items);

if(items.length>2){
	var i=2
	while( i<items.length){
		recomList.remove(items[i]);
		i+=1;
	}
}

if(items.length>0){
		var n=0;
		while(n<items.length){
			var random = Math.floor((Math.random() * items.length)+1)-1;
			if(getURL(random)){break;}
			n++;
		}
		
		function checkLength(message,key){
					if(message!=null){
						if(key=='title'){
							$('#recommendationList').append("<tr id="+key+"><td class='bookBar' colspan='2'><p>"+message+"</p></td></tr>");	
						}
						else if(key=='imageLinks'){
							$('#recommendationList').append("<tr id="+key+"><td rowspan='3'><img src ='"+message+"' alt='book thumbnail'/></td>");
						}else if(key=='authors'){
							$('#recommendationList').append("<td class='inforBar' id="+key+"><i class='fa fa-user-circle'></i>&nbsp;"+message+"</td></tr>");

						}else if(key=='previewLink'){
							$('#recommendationList').append("<tr id="+key+"><td><a class='inforBar' href='"+message+"'><i class='fa fa-book'></i>&nbsp;Link of this book</a></td></tr>")
						}
					}	
				}
		function getURL(index){
			var isbn = items[index];
			$.get("https://www.googleapis.com/books/v1/volumes?q=isbn:" + isbn,function(response){
						console.log(response);
						if(response.items){
							var info = response.items[0].volumeInfo;
							var list ={
							"title" : info.title,
							 
							 "imageLinks" : info.imageLinks.thumbnail,
							 "authors": info.authors,
							 "previewLink" : info.previewLink
							};
							for (var key in list){checkLength(list[key],key);}
							return true;
						}else{
							return false;
						}
					});
		}
	
}else{
	$('#recommendationList').append("<tr id='nullRecom'><p>Oh no! You have no search history till now...</p></tr>")
}

function unique(arr){
	arr.sort();
	var n=[arr[0]];
	for (var i=1; i<arr.length; i++){
		if(arr[i]!=arr[i-1]){
			n.push(arr[i]);
		}
	}
	return n;
}