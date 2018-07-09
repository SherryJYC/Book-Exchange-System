var searchId=null;

            /*
            function showSuggestion(){
                var suggestions=[];           

                //Reserved part: Use AJAX to get suggestions

                    var xhttp=new XMLHttpRequest(); //Without considering IE6
                    xhttp.onreadystatechange=function(){
                        if(this.readyState==4 && this.status==200){

                        }
                    }
                    xhttp.open("GET","https://www.googleapis.com/books/v1/volumes?q="+,true);
                    xhttp.send();
                
                //Only for testing (without AJAX)
                

                //Change the suggestions
                setTimeout(function(){
                    var res="";
                    for(var i=0;i<suggestions.length;i++){
                        res=res+"<li><a href='javascript:selectSuggestion("+suggestions[i]+")'>"+document.getElementById("content").value+suggestions[i]+"</a></li>";
                    }
                    document.getElementById("suggestionMenu").innerHTML=res;
                },100);
            }
            */


            function selectSuggestion(s){
                document.getElementById("content").value=s;
                //document.getElementById("searchForm").submit();
            }
            
            $("#content").keydown(function(){
                clearTimeout(searchId);
                searchId=setTimeout(function(){
                    var search = $("#content").val();
                    $("#suggestionMenu").html("");
                    $.get("https://www.googleapis.com/books/v1/volumes?q="+search, function(response){
                        $("#suggestionMenu").append("</br><p style='color:Maroon;'><b>Are You Looking for:</b></p><a href='javascript:selectSuggestion(\""+response.items[0].volumeInfo.title+"\")'>"+response.items[0].volumeInfo.title+"</a>");
                    });
                },2000)
                
            });
            var list = new cookieList('recomList','./user_home.php');
            $("#searchButton").click(function(){
                var search = $("#content").val();
                $("#searchResult").html("");
                $.get("https://www.googleapis.com/books/v1/volumes?q="+search, function(response){                
                    console.log(response);
					$("#searchResult").append("<div class='inContainer' style='width:60%;'><form method='POST'><table id='resultTable' class='bookshell' align='center'><tr><th>Name</th><th>Author</th><th>ISBN</th><th></th></tr></table>");
                    for(i=0;i<response.items.length;i++){
						var title = response.items[i].volumeInfo.title;
						var author = response.items[i].volumeInfo.authors[0];
						var ISBN = response.items[i].volumeInfo.industryIdentifiers[1].identifier;
						if(i<4){list.add(ISBN);}
				
                     $("#resultTable").append("<tr><td name='title'><a href='bookinfo.php?isbn="+ISBN+"&title="+title+"'>" + response.items[i].volumeInfo.title + "</td><td>" + response.items[i].volumeInfo.authors[0] + "</td><td>" + response.items[i].volumeInfo.industryIdentifiers[1].identifier + "</td><td><input type='button' class='btn' value='borrow' onclick='window.location=\"user_searchOwner.php?isbn="+response.items[i].volumeInfo.industryIdentifiers[1].identifier+"\"'> <input type='button' class='btn' value='lend' name='lendBtn' onclick='window.location=\"user_addBook.php?isbn="+response.items[i].volumeInfo.industryIdentifiers[1].identifier+"&name="+response.items[i].volumeInfo.title+"\"'/></br></br></td></tr>");
                    }
                    $("#resultTable").append("</table></div>"); 
                });
            });