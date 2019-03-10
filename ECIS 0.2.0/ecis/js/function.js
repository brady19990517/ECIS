/*function createTB(activity){
//alert('function.js');
//console.log(activity);

//alert(activity);
  
  $.ajax({
            url: 'action/action.php',
            type: 'POST',
            dataType: 'html',
            data: {act:'createTB',activity: activity}
          })
          .done(function(result){
              alert("upload success");
              var x = document.createElement("INPUT");
              var y = document.getElementById("upload");
              x.setAttribute("type", "file");
              y.appendChild(x);
              
          })
          .fail(function(){
            alert("上傳失败");
          });
}*/
function insertAct(activity){
  
  if(activity==""){
    setTimeout(function(){window.location.href='/ecis/upload.php';},0);
    alert("please enter a valid name");
    return;
  }
  
  $.ajax({
    url: 'action/action.php',
    type: 'POST',
    dataType: 'html',
    data: {act:'insertAct',activity: activity}
  })
  .done(function(result){
      if(result == 0){
        alert("name cannot be repeated");
        setTimeout(function(){window.location.href='/ecis/upload.php';},0);
        return;
      }else{
        alert("Activity created successfully, please upload the activity file");
        document.write("<script>window.location.href=\'file_upload.php\';</script>");
      }
      
     
      
  })
  .fail(function(){
    setTimeout(function(){window.location.href='/ecis/upload.php';},0);
    alert("上傳失败");
  });
}
/*function login(){
  var username = $("#username").val();
  
  var password = $("#password").val();
  
  $.ajax({
    url: 'action.php',
    type: 'POST',
    dataType: 'html',
    data: {act: 'login', username: username,password:password}
  }).done(function(result){
    if(result == 'success'){
      
      document.write("<script>window.location.href=\'upload.php\';</script>");
      
    }else if(result == 'usernamewrong'){
      alert("username错误");
    }else{
      alert("password错误");
    }
  }).fail(function(){
    console.log('fail');
  }).always(function(){
    
  });
}*/
