
//window.$ = window.jQuery = require('jquery');
import axios from 'axios';

var timer = null;
function search_request(value) {
  axios.post(URL.search,{
    keyword:value
  }).then(res=>{
    //console.log(res.data.length);
    $('#liveSearch-result-block').html('');
    if(res.posts.length==0){
      return;
    }
    var add_ul = ""
    if(res.posts.length!=0){
      add_ul+='<ul class=\"list-group\">';
      for (var i = 0; i < res.data.posts.length; i++) {
        add_ul+="<li class=\"list-group-item\"><a href=\""+URL.posts+"/"+res.data.posts[i].id+"\">"+res.data.posts[i].title+"</a></li>";
      }
      add_ul+='</ul>';
    }

    $('#liveSearch-result-block').html(add_ul);
    //console.log('ok');
  }).catch(err=>{
    //console.log(err);
    //console.log('error');
  });
}

$(document).ready(()=>{
  console.log('ready');
  $('#liveSearch-button').keyup(function(){
    var value=$(this).val();
    value=value.trim();

    if (!value) {
      $('#liveSearch-result-block').html('');
      return;
    };
    clearTimeout(timer);
    timer = setTimeout(function() {
      search_request(value);
    }, 200);
  });
});
