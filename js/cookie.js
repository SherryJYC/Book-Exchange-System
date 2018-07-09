	var cookieList = function(cookieName, path){
	var cookie = Cookies.get(cookieName);
	var items = cookie ? cookie.split(/,/) : new Array();
	
	return{
		"add": function(item){
			items.push(item);
			Cookies.set(cookieName,items.join(','),{path:path , expires: 3});
		},
		"remove": function(item){
			idx = items.valueOf(item);
			if(idx != -1){items.splice(idx,1);}
			Cookies.set(cookieName,items.join(','),{path:path , expires: 3});
		},
		"clear": function(item){
			Cookies.remove(cookieName);
		},
		"items": function(){
			return items;
		}
	}
}