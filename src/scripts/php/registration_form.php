<?php
session_start();
if (!isset($_SESSION['user']))
{
    header("location:login_form.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Eventbox</title>
    
    <link rel="stylesheet" type="txt/css" href="../../bootstrap/css/bootstrap.min.css">   
    <link rel="stylesheet" type="txt/css" href="../../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="../js/function.js"></script>
</head>
<script>
var order=[];
var count=0;
function store()
{
    var label = document.getElementsByTagName('LABEL');
    for (var i = 0; i < label.length; i++) 
    {
        if (label[i].htmlFor != '') 
        {
            var elem = document.getElementById(label[i].htmlFor);
            order[i]= [label[i].htmlFor,elem.value,elem.getAttribute("name")];   
            //store by [(id),(labelname),(type)] 
        }
    }
    var ord = JSON.stringify(order);
    window.location.href = "create_registration_form.php?order="+ord;
}
function labelchng(labelId)
{
    var label = document.getElementById(labelId).value;
    document.getElementById('newlbl').value=label;
    document.getElementById('oldlbl').value=labelId;
}
function okchng()
{
    var oldlbl = document.getElementById('oldlbl').value;
    var newlbl = document.getElementById("newlbl").value;
    document.getElementById(oldlbl).value=newlbl
}
function delelem(labelId)
{
    var formitem=document.getElementById(labelId).parentNode.parentNode.parentNode;
    document.getElementById("delt").value=formitem.id;
}
function okdel()
{
    var fitem=document.getElementById("delt").value;
    document.getElementById(fitem).remove();
}
function addAllInputs(divName,formElemID,labelName){
    var newdiv = document.createElement('div');
    count++;
    switch(formElemID) {
          case 'name':
               newdiv.innerHTML ="<div style='border-top:1px solid rgba(16, 16, 16, 0.12); padding-top:15px;' id='"+count+"'><div class='form-group'><label class='col-md-1 control-label' for='"+formElemID+count+"'><input type='text' id='"+formElemID+count+"' name='"+formElemID+"' style='border:none;background-color:#fff' value='"+labelName+"' disabled></label><div class='col-md-4'><input id='"+formElemID+count+"' type='text' disabled class='form-control' placeholder='First'></div><div class='col-md-4'><input id='"+formElemID+count+"' type='text' disabled class='form-control' placeholder='Last'></div><div class='col-md-2'><div class='row'><div class='col-md-3'><button form='' class='btn btn-default' data-toggle='modal' data-target='.bs-edit-field' value='"+formElemID+count+"' onclick='labelchng(this.value)'><span class='glyphicon glyphicon-edit'></span></button></div><div class='col-md-3'><button class='btn btn-default' data-toggle='modal' form='' data-target='.bs-trash-field' value='"+formElemID+count+"' onclick='delelem(this.value)'><span class='glyphicon glyphicon-trash'></span></button></div><div class='col-md-3'><button form='' class='btn btn-default' value='"+formElemID+count+"' id='up"+count+"' onclick='moveUp(this.id)'><span class='glyphicon glyphicon-arrow-up'></span></button></div><div class='col-md-3'><button form='' id='down"+count+"' onclick='moveDown(this.id)' class='btn btn-default' value='"+formElemID+count+"'><span class='glyphicon glyphicon-arrow-down'></span></button></div></div></div></div></div>";
               break;

          case 'date':
               newdiv.innerHTML ="<div style='border-top:1px solid rgba(16, 16, 16, 0.12); padding-top:15px;' id='"+count+"'><div class='form-group'><label class='col-md-1 control-label' for='"+formElemID+count+"'><input type='text' id='"+formElemID+count+"' name='"+formElemID+"' style='border:none;background-color:#fff' value='"+labelName+"' disabled></label><div class='col-md-4'><input type='text' id='"+formElemID+count+"' name='"+formElemID+"' disabled class='form-control' placeholder='mm'></div><div class='col-md-2'><input  id='"+formElemID+count+"' type='text' disabled class='form-control' placeholder='dd'></div><div class='col-md-2'><input type='text' disabled class='form-control'  id='"+formElemID+count+"' placeholder='yyyy'></div><div class='col-md-2'><div class='row'><div class='col-md-3'><button form='' class='btn btn-default' data-toggle='modal' data-target='.bs-edit-field' value='"+formElemID+count+"' onclick='labelchng(this.value)'><span class='glyphicon glyphicon-edit'></span></button></div><div class='col-md-3'><button class='btn btn-default' data-toggle='modal' form='' data-target='.bs-trash-field' value='"+formElemID+count+"' onclick='delelem(this.value)'><span class='glyphicon glyphicon-trash'></span></button></div><div class='col-md-3'><button form='' class='btn btn-default' value='"+formElemID+count+"' id='up"+count+"' onclick='moveUp(this.id)'><span class='glyphicon glyphicon-arrow-up'></span></button></div><div class='col-md-3'><button form='' class='btn btn-default' value='"+formElemID+count+"' id='down"+count+"' onclick='moveDown(this.id)'><span class='glyphicon glyphicon-arrow-down'></span></button></div></div></div></div></div>";
               break;
          case 'email':
               newdiv.innerHTML = "<div style='border-top:1px solid rgba(16, 16, 16, 0.12); padding-top:15px;' id='"+count+"'><div class='form-group'><label class='col-md-1 control-label' for='"+formElemID+count+"'><input type='text' id='"+formElemID+count+"' name='"+formElemID+"' style='border:none;background-color:#fff' value='"+labelName+"' disabled></label><div class='col-md-8'><input type='email' id='"+formElemID+count+"' disabled class='form-control' placeholder='eventbox@eventbox.com'></div><div class='col-md-2'><div class='row'><div class='col-md-3'><button form='' class='btn btn-default' data-toggle='modal' data-target='.bs-edit-field' value='"+formElemID+count+"' onclick='labelchng(this.value)'><span class='glyphicon glyphicon-edit'></span></button></div><div class='col-md-3'><button class='btn btn-default' data-toggle='modal' form='' data-target='.bs-trash-field' value='"+formElemID+count+"' onclick='delelem(this.value)'><span class='glyphicon glyphicon-trash'></span></button></div><div class='col-md-3'><button form='' class='btn btn-default' value='"+formElemID+count+"' id='up"+count+"' onclick='moveUp(this.id)'><span class='glyphicon glyphicon-arrow-up'></span></button></div><div class='col-md-3'><button form='' class='btn btn-default' value='"+formElemID+count+"' id='down"+count+"' onclick='moveDown(this.id)'><span class='glyphicon glyphicon-arrow-down'></span></button></div></div></div></div></div>";
               break;
          case 'address':
               newdiv.innerHTML = "<div style='border-top:1px solid rgba(16, 16, 16, 0.12); padding-top:15px;' id='"+count+"'><div class='form-group'><label class='col-md-1 control-label' for='"+formElemID+count+"'><input type='text' id='"+formElemID+count+"' name='"+formElemID+"' style='border:none;background-color:#fff' value='"+labelName+"' disabled></label><div class='col-md-4' ><input type='text' id='"+formElemID+count+"' disabled class='form-control' placeholder='Country'><input id='"+formElemID+count+"' type='text' disabled class='form-control event' placeholder='City'></div><div class='col-md-4' ><input id='"+formElemID+count+"' type='text' disabled class='form-control' placeholder='State'><input type='text' id='"+formElemID+count+"' disabled class='form-control event' placeholder='Street'></div><div class='col-md-2'><div class='row'><div class='col-md-3'><button form='' class='btn btn-default' data-toggle='modal' data-target='.bs-edit-field' value='"+formElemID+count+"' onclick='labelchng(this.value)'><span class='glyphicon glyphicon-edit'></span></button></div><div class='col-md-3'><button class='btn btn-default' data-toggle='modal' form='' data-target='.bs-trash-field' value='"+formElemID+count+"' onclick='delelem(this.value)'><span class='glyphicon glyphicon-trash'></span></button></div><div class='col-md-3'><button form='' class='btn btn-default' value='"+formElemID+count+"' id='up"+count+"' onclick='moveUp(this.id)'><span class='glyphicon glyphicon-arrow-up'></span></button></div><div class='col-md-3'><button form='' class='btn btn-default' value='"+formElemID+count+"' id='down"+count+"' onclick='moveDown(this.id)'><span class='glyphicon glyphicon-arrow-down'></span></button></div></div></div></div></div>";
               break;
          case 'text':
               newdiv.innerHTML = "<div style='border-top:1px solid rgba(16, 16, 16, 0.12); padding-top:15px;' id='"+count+"'><div class='form-group'><label class='col-md-1 control-label' for='"+formElemID+count+"'><input type='text' id='"+formElemID+count+"' name='"+formElemID+"' style='border:none;background-color:#fff' value='"+labelName+"' disabled></label><div class='col-md-8'><input type='text' disabled id='"+formElemID+count+"' class='form-control' placeholder='"+labelName+"'></div><div class='col-md-2'><div class='row'><div class='col-md-3'><button form='' class='btn btn-default' data-toggle='modal' data-target='.bs-edit-field' value='"+formElemID+count+"' onclick='labelchng(this.value)'><span class='glyphicon glyphicon-edit'></span></button></div><div class='col-md-3'><button class='btn btn-default' data-toggle='modal' form='' data-target='.bs-trash-field' value='"+formElemID+count+"' onclick='delelem(this.value)'><span class='glyphicon glyphicon-trash'></span></button></div><div class='col-md-3'><button form='' class='btn btn-default' value='"+formElemID+count+"' id='up"+count+"' onclick='moveUp(this.id)'><span class='glyphicon glyphicon-arrow-up'></span></button></div><div class='col-md-3'><button form='' class='btn btn-default'  value='"+formElemID+count+"' id='down"+count+"' onclick='moveDown(this.id)'><span class='glyphicon glyphicon-arrow-down'></span></button></div></div></div></div></div>";
               break;
          case 'textarea':
               newdiv.innerHTML = "<div style='border-top:1px solid rgba(16, 16, 16, 0.12); padding-top:15px;' id='"+count+"'><div class='form-group'><label class='col-md-1 control-label' for='"+formElemID+count+"'><input type='text' id='"+formElemID+count+"' name='"+formElemID+"' style='border:none;background-color:#fff' value='"+labelName+"' disabled></label><div class='col-md-8'> <textarea disabled id='"+formElemID+count+"' class='form-control' placeholder='Type Here...'></textarea></div><div class='col-md-2'><div class='row'><div class='col-md-3'><button form='' class='btn btn-default' data-toggle='modal' data-target='.bs-edit-field' value='"+formElemID+count+"' onclick='labelchng(this.value)'><span class='glyphicon glyphicon-edit'></span></button></div><div class='col-md-3'><button class='btn btn-default' data-toggle='modal' form='' data-target='.bs-trash-field' value='"+formElemID+count+"' onclick='delelem(this.value)'><span class='glyphicon glyphicon-trash'></span></button></div><div class='col-md-3'><button form='' class='btn btn-default' value='"+formElemID+count+"' id='up"+count+"' onclick='moveUp(this.id)'><span class='glyphicon glyphicon-arrow-up'></span></button></div><div class='col-md-3'><button form='' class='btn btn-default' value='"+formElemID+count+"' id='down"+count+"' onclick='moveDown(this.id)'><span class='glyphicon glyphicon-arrow-down'></span></button></div></div></div></div></div>";
               break;
          case 'link':
               newdiv.innerHTML = "<div style='border-top:1px solid rgba(16, 16, 16, 0.12); padding-top:15px;' id='"+count+"'><div class='form-group'><label class='col-md-1 control-label' for='"+formElemID+count+"'><input type='text' id='"+formElemID+count+"' name='"+formElemID+"' style='border:none;background-color:#fff' value='"+labelName+"' disabled></label><div class='col-md-8'><input type='text' disabled class='form-control' id='"+formElemID+count+"' placeholder='https://'></div><div class='col-md-2'><div class='row'><div class='col-md-3'><button form='' class='btn btn-default' data-toggle='modal' data-target='.bs-edit-field' value='"+formElemID+count+"' onclick='labelchng(this.value)'><span class='glyphicon glyphicon-edit'></span></button></div><div class='col-md-3'><button class='btn btn-default' data-toggle='modal' form='' data-target='.bs-trash-field' value='"+formElemID+count+"' onclick='delelem(this.value)'><span class='glyphicon glyphicon-trash'></span></button></div><div class='col-md-3'><button form='' class='btn btn-default' value='"+formElemID+count+"' id='up"+count+"' onclick='moveUp(this.id)'><span class='glyphicon glyphicon-arrow-up'></span></button></div><div class='col-md-3'><button form='' class='btn btn-default' value='"+formElemID+count+"' id='down"+count+"' onclick='moveDown(this.id)'><span class='glyphicon glyphicon-arrow-down'></span></button></div></div></div></div></div>";
               break;
    }
    document.getElementById(divName).appendChild(newdiv);
}
function moveUp(id)
{
  var div_id=document.getElementById(id).parentNode.parentNode.parentNode.parentNode.parentNode.id;
  var div_id2=parseInt(div_id)-1;
  if(div_id2!=0)
  {
    var div1=document.getElementById(div_id);
    var div2=document.getElementById(div_id2);
    var div3=div2.innerHTML;
    div2.innerHTML=div1.innerHTML;
    div1.innerHTML=div3;
  }
  else
  {
    document.getElementById(div_id).disabled=true;
  }
}
function moveDown(id)
{
  var div_id=document.getElementById(id).parentNode.parentNode.parentNode.parentNode.parentNode.id;
  var div_id2=parseInt(div_id)+1;
  var div1=document.getElementById(div_id);
  var div2=document.getElementById(div_id2);
  var div3=div2.innerHTML;
  div2.innerHTML=div1.innerHTML;
  div1.innerHTML=div3;
}
</script>
<body>
    
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation"><!-- /navigation -->
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../../index.php"><img src="../../images/eventbox-logo.png" width="175px"/></a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="img-responsive">
                        <img style="padding:5px; margin-top:2px;" class="hidden-xs" src="http://a.deviantart.net/avatars/m/b/mb67.gif?3" width="50px" height="50px">
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user']['name']; ?><b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="home.php">Home</a></li>
                        <li><a href="my_event.php">Profile</a></li>
                        <li><a href="#">Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="my_event.php?log=out">Log out</a></li>
                      </ul>
                    </li>
                  </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav><!-- /navigation--> 
    
    <div class="container event">
        <div class="row">
            <div class="col-md-12">                
                <div class="row"><!--content header-->
                    <div class="col-md-8">
                        <h2>Create Registration Form <small>Step 2 of 4</small></h2>
                    </div>
                    <div class="col-md-4">
                        <a href="create_event.php"class="event btn btn-default pull-right">Cancel</a>                        
                    </div>
                </div> <!--end content header-->
                <hr>
            </div>            
            <div class="row">
                <div class="col-md-12">
                <div class="col-md-3 ">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="text-center">Input Type</h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">                            
                                    <button class="btn btn-default btn-block" onclick="addAllInputs('form','name','Name')">Name</button>
                                    <button class="btn btn-default btn-block" onclick="addAllInputs('form','date','Date')">Date</button>
                                    <button class="btn btn-default btn-block" onclick="addAllInputs('form','email','Email')">Email</button>
                                    <button class="btn btn-default btn-block" onclick="addAllInputs('form','address','Address')">Address</button>
                                    <hr>
                                    <button class="btn btn-default btn-block" onclick="addAllInputs('form','text','Text')">Text</button>
                                    <button class="btn btn-default btn-block" onclick="addAllInputs('form','textarea','TextArea')">TextArea</button>
                                    <button class="btn btn-default btn-block" onclick="addAllInputs('form','link','Link')">Link</button>
                                </div>
                            </div>
                        </div>
                    </div>
				
                </div>
                <div class="col-md-9">
                    <div class="row">                        
                        <div class="col-md-12 text-center">
                            <div class="panel panel-default">                                
                                <div class="panel-header">
                                    <h3>Registration Form</h3>
                                </div>
                                <hr>
                                <div class="panel-body">
                                    <form role="form" class="form-horizontal" action="#">
										<div class='form-group '>
											<label for='name' class="col-md-1 col-md-offset-1 control-label text-right">					
												<input type='text' name="name" id="name" style='border:none;background-color:#fff' value="Name" disabled>									
											</label>										
											<div class='col-md-4'>
												<input type='text' id='name' class="form-control" disabled class='' placeholder='First'>
											</div>
											<div class='col-md-4'>
												<input type='text' id='name' class="form-control" disabled class='' placeholder='Last'>
											</div>
										</div>
										
                                        <div class="form-group">
                                                <label for="email" class="col-md-1 col-md-offset-1 control-label"><input type='text' name="email" id="email" style='border:none;background-color:#fff' value="Email" disabled></label>
                                            <div class="col-md-8">
                                                <input type="email" id="email" disabled class="form-control" placeholder="eventbox@eventbox.com">
                                            </div>
                                        </div>
										
                                        <div class='' id="form">
                                            <div class='form-group'>
                                                <label for='address' class="col-md-1 col-md-offset-1 control-label">
													<input type='text' name="address" id="address" style='border:none;background-color:#fff' value="Address" disabled>
												</label>
													<div class="col-md-4">
														<input type='text' id='address' disabled class='form-control' placeholder='Country'>
                                                		<input type='text' id='address' disabled class='form-control event' placeholder='State'>
													</div>
													<div class="col-md-4">
														<input type='text' id='address' disabled class='form-control' placeholder='City'>
                                                		<input type='text' id='address' disabled class='form-control event' placeholder='Street'>
													</div>
											</div>
                                        </div>
                                    </form>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
                </div>                       
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <a href="create_event.php" class="btn btn-primary btn-lg pull-right">back</a>
                    </div>
                    <div class="col-md-1 col-md-offset-4">
                        <button onclick="store()" class="btn btn-success btn-lg">Next</button>
                    </div>                   
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div class="modal fade bs-edit-field" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    Label:
                    <input type="hidden" id="oldlbl" disabled></input>
                    <input type="text" id="newlbl"></input>
                    <button onclick="okchng()" data-dismiss="modal">OK</button>
                </div>
            </div> <!-- /.modal-content -->
      </div>
    </div>
    <div class="modal fade bs-trash-field" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    Are you sure?
                    <input type="hidden" id="delt" disbaled></input>
                    <button data-dismiss="modal" onclick="okdel()" >OK</button>
                </div>
            </div> <!-- /.modal-content -->
      </div>
    </div>



</body>
</html>
