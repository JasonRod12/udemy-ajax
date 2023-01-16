window.onload = hide(document.querySelectorAll('#edit_post_form'));
window.onload = get_posts();

function showloading(){
  var target = document.getElementById('display_post');
  target.innerHTML = 'Loading....';
}
//function to handel hide and show effect
function hide(elements){
elements = elements.length ? elements : [elements];
for(var index = 0; index < elements.length; index++){
  elements[index].style.display = 'none';
}
}


function show(elements){
elements = elements.length ? elements : [elements];
for(var index = 0; index < elements.length; index++){
  elements[index].style.display = 'block';
}
}

var output = document.getElementById('output');

//create Post
function create_post(fdata){
var mydata = new FormData(fdata);

var xhr = new XMLHttpRequest();
xhr.onload = function(){
  displayMessage(xhr.responseText);
}
xhr.open(fdata.method, fdata.action, true);
xhr.send(mydata);

return false; //prevent the form from posting
}


//Get All Posts
function get_posts(){
  var url = 'http://localhost/ajax_php_POST/api/posts/read.php';
  var xhr = new XMLHttpRequest();
  xhr.open('GET', url, true);

  xhr.onreadystatechange = function () {
    if(xhr.readyState < 4){
      showloading();
    }
    if(xhr.readyState == 4 && xhr.status == 200){
      console.log(xhr.responseText);
      displayPost(xhr.responseText); // call display post
    }
  };
  xhr.send();
}

//Display Posts
function displayPost(data)
{
  var target = document.getElementById('display_post');

  var jcontent = JSON.parse(data);
  var text = "";
  var i;
  for(i = 0; i < jcontent.data.length; i++){

    var post_id = jcontent.data[i].post_id;
    text += '<div class="post_holder">';
    text += '<div class="post_title"><h5>'+jcontent.data[i].post_title+'</h5></div>';
    text += '<div class="post_details">'+jcontent.data[i].post_body+'</div>';
    text += '<button type="button" class="button" onclick="edit_post('+post_id+');">Edit Post</button>&nbsp; &nbsp;';
    text += '<button type="button" class="alert button" onclick="delete_post('+post_id+');">Delete Post</button>&nbsp; &nbsp;';
    text += '</div>';
  }

  target.innerHTML = text;
}


//Edit Post
function edit_post(param)
{
  hide(document.querySelectorAll('#create_post_form'));
  show(document.querySelectorAll('#edit_post_form'));

var url = 'http://localhost/ajax_php_POST/api/posts/read_single.php?post_id='+param;
var xhr = new XMLHttpRequest();
xhr.open('GET', url, true);

xhr.onreadystatechange = function(){
  if(xhr.readyState < 4){
    showloading();
  }
  if(xhr.readyState == 4 && xhr.status == 200){
    console.log(xhr.responseText);
    prepare_edit_form(xhr.responseText); // prepare edit form
  }
};
xhr.send();
  //hide all the posts
  hide(document.querySelectorAll('#display_post'));
}


//Prepare Edit Post Form
function prepare_edit_form(data){
var jcontent = JSON.parse(data);
document.getElementById('edit_post_title').value = jcontent.post_title;
document.getElementById('edit_post_body').value = jcontent.post_body;
document.getElementById('edit_post_id').value = jcontent.post_id;
}


//Update Post
function updateData(fdata)
{
 var mydata = new FormData(fdata);

 var xhr = new XMLHttpRequest();
 xhr.onload = function(){
   displayUpdateMessage(xhr.responseText);
 }
 xhr.open(fdata.method, fdata.action, true );
 xhr.send(mydata);

 return false;// prevent the form from posting
}

//Delete Post
function delete_post(param)
{
  var et;
  var et = confirm('Are you sure you want to DELETE this Post..?');
  if(et == true)
  {
    var url = 'http://localhost/ajax_php_POST/api/posts/delete.php?post_id='+param;
    var xhr = new XMLHttpRequest();
    xhr.open('DELETE', url, true);

    xhr.onreadystatechange = function(){
      if(xhr.readyState < 4){
        showloading();
      }
      if(xhr.readyState == 4 && xhr.status == 200){
        displayDeleteMessage(xhr.responseText); // prepare edit form
      }
    };
    xhr.send();

  }
  else{
    return false;
  }
}
//Display update Post message
function displayUpdateMessage(data)
{
var target = document.getElementById('output');
var jcontent = JSON.parse(data);
var text;
text = jcontent.message;
target.innerHTML = text;
//empty the edit post form
 document.getElementById('edit_post_form').reset();

 hide(document.querySelectorAll('#edit_post_form'));
 show(document.querySelectorAll('#create_post_form'));
 show(document.querySelectorAll('#display_post'));
 get_posts(); //get all the post
}
//Display Json Response message
function displayMessage(data){
var target = document.getElementById('output');
var jcontent = JSON.parse(data);
var text = '';
text = jcontent.message;
target.innerHTML = text;
//empty the form
document.getElementById('create_post_form').reset();
get_posts(); //get all the post
}


//Delete Post message

function displayDeleteMessage(data)
{
 var target = document.getElementById('output');
 var jcontent = JSON.parse(data);
 var text = "";
 text = jcontent.message;
 target.innerHTML = text;
 get_posts(); //get all the post
}
