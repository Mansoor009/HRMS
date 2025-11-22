
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
    }

    .fa-bars {
        font-size: 25px;
        border: none;
        padding: 8px 12px;
        border-radius: 50%;
        background-color: white;
        cursor: pointer;
    }

    .fa-bars:hover {
        background-color: rgb(221, 221, 221);
    }
    .fa-xmark {
        font-size: 25px;
        border: none;
        padding: 8px 12px;
        border-radius: 50%;
        cursor: pointer;
        float: right;
    }

    .fa-xmark:hover {
        background-color: rgb(221, 221, 221);
    }

    .side-nav-wrapper a {
        text-decoration: none;
        color: black;
        font-size: 20px;
        padding: 10px;
    }

    .side-nav-wrapper {
        display: flex;
        flex-direction: column;
        width: 15%;
        height: 100%;
        padding: 10px;
        transform: translateX(-309px);
        transition: 350ms ease-in-out;
        background-color: rgb(194, 194, 194);
        position: fixed;
    }

    .out-nav {
        transform: translateX(0px);
        transition: 350ms ease-in-out;
    }
    @media screen and (max-width:991px) {
        .side-nav-wrapper {
        width: 20%
    }

}
    @media screen and (max-width:767px) {
        .side-nav-wrapper {
        width: 25%
    }

}
    @media screen and (max-width:530px) {
        .side-nav-wrapper {
        width: 35%
    }

}
    @media screen and (max-width:390px) {
        .side-nav-wrapper {
        width: 43%
    }

}
</style>
    
    <nav>
        <div class="side-nav-wrapper">
            <div class="close-btn">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <a href="<?php echo e(route('member.dashboard')); ?>">Attendance</a>
            <a href="<?php echo e(route('leave.dashboard')); ?>">Leave Dashboard</a>
        </div>
    </nav>
    <div class="open-btn">
        <i class="fa-solid fa-bars"></i>
    </div>

<script>
    //<i class="fa fa-times" aria-hidden="true"></i>
    let sideNav = document.querySelector(".side-nav-wrapper")
    let openBtn = document.querySelector(".fa-bars")
    openBtn.addEventListener("click", (e) => {
        sideNav.classList.add("out-nav")
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    })
    let closeBtn = document.querySelector(".fa-xmark")
    closeBtn.addEventListener("click",(e)=>{
        sideNav.classList.remove("out-nav")
        document.body.style.backgroundColor = "white";
    })
</script>
<?php /**PATH C:\laragon\www\HRMS\resources\views\layouts\member_sidenavbar.blade.php ENDPATH**/ ?>