
<style>
    .menu3-left{
        float: left;
        width: 10%;
        background-color: #0c1f40;
        height: 100px;
    }

    .menu3-left img{
        width: 100%;
        height: 100%;
        padding: 10%;
    }

    .menu3-right{
        float: right;
        width: 90%;
    }

    .menu3-right{
        border: 0;
         border-radius: 0px;
         margin-bottom: 0px;
        height: auto !important;
        color: #555;
        background-color: #fff !important;
        padding: 0px !important;
        box-shadow: 0px 0px 0px rgba(0, 0, 0, 0), 0 0 0 0 rgba(0, 0, 0, 0);
    }
	
	.menu3{
	   padding:0px;
        border: 0;
         border-radius: 0px;
         margin-bottom: 0px;
        height: auto !important;
        color: #555;
		background-color: #ffffff00 !important;
        padding: 0px !important;
		box-shadow: 0px 0px 0px 0px rgba(0,0,0,0) inset;
    -webkit-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0) inset;
    -moz-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0) inset;

    }
	.menu3-nav{
		   padding:0px;
        border: 0;
         border-radius: 0px;
         margin-bottom: 0px;
        height: auto !important;
        color: #555;
		background-color: #e6fffc !important;
        padding: 0px !important;
/*        box-shadow: 0px 0px 0px rgba(0, 0, 0, 0), 0 0 0 0 rgba(0, 0, 0, 0);*/
		box-shadow: 0px -5px 18px -6px rgba(0,0,0,0.75) inset;
    -webkit-box-shadow: 0px -5px 26px -12px rgba(0,0,0,0.75) inset;
    -moz-box-shadow: 0px -5px 18px -4px rgba(0,0,0,0.75) inset;
	}
	
	   .navbar{
	   padding:0px;
        border: 0;
         border-radius: 0px;
         margin-bottom: 0px;
        height: auto !important;
        color: #555;
		background-color: #fff0 !important;
        padding: 0px !important;
        box-shadow: 0px 0px 0px rgba(0, 0, 0, 0), 0 0 0 0 rgba(0, 0, 0, 0);

    }
		


    .navbar .collapse .navbar-nav .nav-item .nav-link {
        position: relative;
        padding: 5px 5px;
        font-weight: 400;
        text-transform: uppercase;
        border-radius: 3px;
        line-height: 20px;
        margin-left: 5px;
        color: inherit;
    }
/*	
	.navbar-nav .nav-item ::after {
 	 	content: "|";
		font-size:10px;
	}*/
	
		
	.navbar-nav .nav-item{
		border-right: 1px solid;
	}
	
	
<!--	menu Drop down css start-->
.dropdown {
  position: relative;
  display: inline-block;
  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
  font-size: 14px;
}

.dropdown > a, .dropdown > button {
  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
  font-size: 14px;
  background-color: white;
  border: 1px solid #ccc;
  padding: 6px 20px 6px 10px;
  border-radius: 4px;
  display: inline-block;
  color: black;
  text-decoration: none;
}

.dropdown > a:before, .dropdown > button:before {
  position: absolute;
  right: 7px;
  top: 12px;
  content: ' ';
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-top: 5px solid black;
}

.dropdown input[type=checkbox] {
  position: absolute;
  display: block;
  top: 0px;
  left: 0px;
  width: 100%;
  height: 100%;
  margin: 0px;
  opacity: 0;
}

.dropdown input[type=checkbox]:checked {
  position: fixed;
  z-index:+0;
  top: 0px; left: 0px; 
  right: 0px; bottom: 0px;
}

.dropdown ul {
  position: absolute;
  top: 18px;
  border: 1px solid #ccc;
  border-radius: 3px;
  left: 0px;
  list-style: none;
  padding: 4px 0px;
  display: none;
  background-color: white;
  box-shadow: 0 3px 6px rgba(0,0,0,.175);
}

.dropdown input[type=checkbox]:checked + ul {
  display: block;
}

.dropdown ul li {
  display: block;
  padding: 6px 20px;
  white-space: nowrap;
  min-width: 100px;
}

.dropdown ul li:hover {
  background-color: #F5F5F5;
  cursor: pointer;
}

.dropdown ul li a {
  text-decoration: none;
  display: block;
  color: black
}

.dropdown .divider {
  height: 1px;
  margin: 9px 0;
  overflow: hidden;
  background-color: #e5e5e5;
  font-size: 1px;
  padding: 0;
}

<!--	menu Drop down css end-->


/*.nav-link::after {
  content: "\f0c2";
  font-family: "Font Awesome 6 Pro";
}*/

.dashboard1-nav-item {
    line-height: 0px !important;
    padding-top: 10px  !important;
    padding-bottom: 10px  !important;
}







.dashboard1-nav-dropdown.show > .dashboard1-nav-dropdown-menu{
	display: !important;
}



</style>


<div class="container-fluid p-0">
    <div class="menu3-left">
        <img src="../../../logo/<?=$_SESSION['user']['group']?>.png">
    </div>

    <div class="menu3-right">
        <section class="section1">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">

                <div class="collapse menu3-nav navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Purchase Module </a>                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="#"> Warehouse Module </a>                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="#">Sales Module </a>                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="#">MIS Module </a>                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="#">Accounts Module </a>                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">HRM Module </a>                        </li>

                    </ul>

                </div>
            </nav>
        </section>

        <section class="section2">
			<div style="width:85%; float: left;">
			
			<nav class="menu3 navbar navbar-expand-lg " style=" position: absolute;">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav " style=" align-items: flex-start; z-index: 1;">

                        <!--<li class="dropdown">
							  <button>Action</button>
							  <label>
								<input type="checkbox">
								<ul>
								  <li onclick="console.log(1)">Action</li>
								  <li>Another Action</li>
								  <li>Something else here</li>
								  <li class="divider"></li>
								  <li>Separated link</li>
								</ul>
							  </label>
	
                        </li>-->
						
						<li>
						
							<div class="dashboard1-nav-dropdown">
							<a class="dashboard1-nav-item  dashboard1-nav-dropdown-toggle"><i class="fas fa-clipboard-list"></i>Configuration </a>
							
								<div class="dashboard1-nav-dropdown-menu">
								<a href="../setup/user_group.php" class="dashboard1-nav-dropdown-item">Company Settings</a>
								<a href="../setup/warehouse_info.php" class="dashboard1-nav-dropdown-item">Warehouse Info</a>
								<a href="../setup/user_info.php" class="dashboard1-nav-dropdown-item">User Manage</a>
								<a href="../setup/project_information.php" class="dashboard1-nav-dropdown-item">Project Information</a>
								<a href="../admin/template.php" class="dashboard1-nav-dropdown-item active1">Template Config</a>
								</div>
							</div>
						</li>
						
						<li>
						<div class="dashboard1-nav-dropdown">
								<a class="dashboard1-nav-item  dashboard1-nav-dropdown-toggle">
									<i class="fas fa-clipboard-list"></i>Roll Management 
								</a>
							<div class="dashboard1-nav-dropdown-menu">
								<a href="../user_management/roll_manage_create.php" class="dashboard1-nav-dropdown-item">Roll Create</a>
								<a href="../user_management/roll_manage.php" class="dashboard1-nav-dropdown-item">Roll Manage</a>
							</div>
						</div>
						</li>
						
						
						
												


                    </ul>
					

    

                </div>
            </nav>
			
			
			
			</div>
            
			<div style="width:15%; float: right; padding: 10px 0px 10px 0px;" >
			
			<style>
				.manu3-user{
				 border-top-left-radius: 50px; 
				 background-color: #dbdbdb; 
				 border-bottom-left-radius: 50px;
				}
				
				.menu3-user-img{
				
				}

			</style>
<!--			<div class="manu3-user">
				<div class="menu3-user-img" style="width:20%; float: left;">
					<img src="../../../user_pic/user.png" class="userimg" alt="">
				</div>
				
				<div class="menu3-user-img" style="width:80%; float: right;">
					<h5>Name</h5>
					<p>Des</p>
				</div>
			</div>-->
			
			
			<div class="manu3-user" style=" padding: 10px; ">

					<span class="mt-2"> <img src="../../../user_pic/user.png" class="userimg" alt="" style=" border-radius: 50px; width: 45px; height: 45px;"></span>
					<span class="mt-2" style="position: absolute;">
						<h1 class="pl-2 m-0 bold">Md. Sarwar Jahan</h1>
						<p class="pl-2 m-0 bold">Software Engineer </p>
					</span>
			</div>
			
			
			
			
			
			</div>
        </section>
    </div>
</div>


<script type="text/javascript" src="js/bootstrap/bootstrap-dropdown.js"></script>
<script>
     $(document).ready(function(){
        $('.dropdown-toggle').dropdown()
    });
</script>


<script>
    const currentLocation = location.href;
    const menuItem = document.querySelectorAll('.dashboard1-nav-dropdown-menu a');

    const menuLength = menuItem.length
    var element = document.querySelector('.dashboard1-nav-dropdown');


    for (let i=0; i<menuLength; i++){
        if(menuItem[i].href === currentLocation){
            menuItem[i].classList.add('active1')

            var parentDiv = menuItem[i].parentNode;
            var parentDiv2 = parentDiv.parentNode;
            parentDiv2.classList.add('show')

        }
    }


</script>



