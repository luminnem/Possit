/*
Original MOD by Postimage.org
Modified by Posit
*/

if(typeof postimage_lang==='undefined')
{
	var postimage_lang="english";
	var postimage_add_text="Add image to post";

	function postimage_query_string(postimage_search_name){
		if(window.location.hash){
			postimage_query=window.location.hash.substring(1).split("&");
			for(postimage_i=0;postimage_i<postimage_query.length;postimage_i++){
				postimage_string_data=postimage_query[postimage_i].split("=");
				if(postimage_string_data[0]==postimage_search_name){
					postimage_string_data.shift();
					return unescape(postimage_string_data.join("="));
				}
			}
		}
		return void(0);
	}
	if(opener){
		var postimage_text=postimage_query_string("postimage_text");
		if(postimage_text){
			var postimage_id=postimage_query_string("postimage_id");
			var postimage_area=opener.document.getElementsByTagName('textarea');
			for(var postimage_i=0;postimage_i<postimage_area.length;postimage_i++){
				if(postimage_i==postimage_id){
					break;
				}
			}
			if(opener.editorHandlemessage && opener.editorHandlemessage.bRichTextEnabled){
				opener.editorHandlemessage.insertText(postimage_text+"<br /><br />",false);
				
			}else{
				postimage_area[postimage_i].value=postimage_area[postimage_i].value+postimage_text;
			}
			opener.focus();
			window.close();
		}
	}
	function postimage_insert(){
		var postimage_area=document.getElementsByTagName('textarea');
		for(var postimage_i=0;postimage_i<postimage_area.length;postimage_i++){
			if(!postimage_area[postimage_i].name.match(/username_list|search|recipients/i)){
				postimage_div=document.createElement('div');
				postimage_open=document.createElement('a');
				postimage_open.innerHTML=postimage_add_text;
				postimage_open.href="javascript:postimage_upload("+postimage_i+");";
				postimage_span=document.createElement('span');
				postimage_span.innerHTML="&#160;&#8226;&#160;";
				postimage_div.appendChild(document.createElement('br'));
				postimage_div.appendChild(postimage_span);postimage_div.appendChild(postimage_open);
				postimage_div.appendChild(document.createElement('br'));
				if(postimage_area[postimage_i].nextSibling){
					postimage_area[postimage_i].parentNode.insertBefore(postimage_div,postimage_area[postimage_i].nextSibling);
					
				}else{
					postimage_area[postimage_i].parentNode.appendChild(postimage_div);
				}
			}
		}
	}
	
	function postimage_upload(areaid){
		window.open("http://postimage.org/index.php?mode=website&areaid="+areaid+"&hash=1&lang="+postimage_lang+"&code=hotlink&content=family&forumurl="+escape(document.location.href),"postimage","resizable=yes,width=500,height=400");
		return void(0);
	}
	
	if(typeof postimage_text==='undefined'){
		if(window.addEventListener){
			window.addEventListener('DOMContentLoaded',postimage_insert,false);
			
		}else if(window.attachEvent){
			window.attachEvent('onload',postimage_insert);
		}
	}
}