<style>
.logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 7px 11px;
    border-radius: 50% 50%;
    color: #000000b3;
}
</style>

<nav class="navbar navbar-dark bg-primary fixed-top " style="padding:0;">
    <div class="container-fluid mt-2 mb-2">
        <div class="col-lg-12">
            <div class="col-md-1 float-left" style="display: flex;">
                <img src="assets/img/logo2.png" alt="..." width="50%">
            </div>
            <div class="col-md-4 float-left text-white mt-3">
                <large><b>Laundry Management System</b></large>
            </div>
            <div class="col-md-1 float-right text-white mt-3">
                <a href="logout.php?id=<?=$_SESSION['login_id']?>" class="text-white"> <i
                        class="fa fa-power-off"></i></a>
            </div>
        </div>
    </div>

</nav>
